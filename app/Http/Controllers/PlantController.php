<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Plant;
use App\Models\Lansia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PlantController extends Controller
{
    // Tampilan Landing Page untuk Publik
    public function index() {
        $plants = Plant::all();
        return view('welcome', compact('plants'));
    }

    // Dashboard Admin Utama
    public function dashboard(Request $request) {
        $query = Plant::query();

        // Fitur Filter RW
        if ($request->has('rw') && $request->rw != '') {
            $query->where('rw', $request->rw);
        }

        $plants = $query->get();
        $total_bibit = $query->sum('stok');
        $stok_menipis = $query->clone()->whereColumn('stok', '<=', 'min_stok')->count();
        
        // Data Tips untuk Dashboard
        $tips = Tip::all(); 

        // STATISTIK UNTUK GRAFIK (Chart.js)
        $stats = [
            'Hipertensi' => Lansia::where('penyakit', 'like', '%hipertensi%')->count(),
            'Asam Urat'  => Lansia::where('penyakit', 'like', '%asam urat%')->count(),
            'Diabetes'   => Lansia::where('penyakit', 'like', '%diabetes%')->count(),
            'Sehat'      => Lansia::where('penyakit', 'tidak ada')->count(),
        ];
        
        $lansias = Lansia::all();
        $locations = \App\Models\Location::all();
        
        return view('dashboard', compact('plants', 'total_bibit', 'stok_menipis', 'tips', 'stats', 'lansias', 'locations'));
    }

    public function create() {
        return view('tambah'); 
    }

    public function store(Request $request) {
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
                        $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/plants'), $imageName);
        }
        Plant::create([
            'nama_tanaman' => $request->nama_tanaman,
            'nama_latin'   => $request->nama_latin,
            'image'        => $imageName,
            'kategori'     => $request->kategori,
            'rw'           => $request->rw,
            'manfaat'      => $request->manfaat,
            'cara_olah'    => $request->cara_olah,
            'stok'         => $request->stok,
            'min_stok'     => 10,
            'slug'         => Str::slug($request->nama_tanaman)
        ]);
        return redirect()->route('dashboard')->with('success', 'Tanaman berhasil ditambah!');
    }
    public function edit($id) {
        $plant = Plant::findOrFail($id);
        return view('edit', compact('plant'));
    }
    public function update(Request $request, $id) {
        $plant = Plant::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($plant->image && file_exists(public_path('images/plants/' . $plant->image))) {
                unlink(public_path('images/plants/' . $plant->image));
            }
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/plants'), $imageName);
            $data['image'] = $imageName;
        }
        $data['slug'] = Str::slug($request->nama_tanaman);
        $plant->update($data);
        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui!');
    }
    public function destroy($id) {
        $plant = Plant::findOrFail($id);
        if ($plant->image && file_exists(public_path('images/plants/' . $plant->image))) {
            unlink(public_path('images/plants/' . $plant->image));
        }
        $plant->delete();
        return back()->with('success', 'Tanaman dihapus!');
    }

    
    public function koleksi(Request $request) {
        $query = Plant::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_tanaman', 'like', '%' . $search . '%')
                  ->orWhere('manfaat', 'like', '%' . $search . '%');
            });
        }
        $plants = $query->get();
        return view('koleksi', compact('plants'));
    }
    public function detail($slug) {
        $plant = Plant::where('slug', $slug)->firstOrFail();
        return view('detail', compact('plant'));
    }
    public function cetakLaporan() {
        $plants = Plant::all();
        $total_bibit = Plant::sum('stok');
        $tanggal = date('d F Y');
        $pdf = Pdf::loadView('admin.laporan_pdf', compact('plants', 'total_bibit', 'tanggal'));
        return $pdf->download('Laporan_EcoHealth_'.date('Ymd').'.pdf');
    }
    // --- MANAJEMEN TIPS ---
    public function manageTips() {
        $tips = Tip::all();
        return view('admin.tips', compact('tips'));
    }
    public function storeTip(Request $request) {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'tag'         => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'icon'        => 'nullable|string|max:10',
            'image_file'  => 'nullable|image|max:2048',
            'image_url'   => 'nullable|url|max:500',
        ]);

        $imagePath = null;

        // Prioritas 1: file upload
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('tips', 'public');
        }
        // Prioritas 2: URL gambar
        elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        Tip::create([
            'judul'    => $request->judul,
            'tag'      => $request->tag,
            'deskripsi'=> $request->deskripsi,
            'icon'     => $request->icon,
            'image'    => $imagePath,
        ]);

        return back()->with('success', 'Tips berhasil ditambahkan!');
    }
    public function destroyTip($id) {
        Tip::destroy($id);
        return back();
    }
    public function tips() {
        $tips = \App\Models\Tip::all(); 
        return view('tips', compact('tips'));
    }

    public function sendEmail(Request $request)
    {
        // Validasi semua field yang wajib diisi
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        // Kirim email ke alamat yang dikonfigurasi di .env
        // Ubah CONTACT_RECIPIENT_EMAIL di .env untuk ganti tujuan email
        \Illuminate\Support\Facades\Mail::to(env('CONTACT_RECIPIENT_EMAIL'))
            ->send(new \App\Mail\ContactMail($validated));

        return back()->with('success', 'Pesan berhasil dikirim ke Gmail Desa!');
    }
}