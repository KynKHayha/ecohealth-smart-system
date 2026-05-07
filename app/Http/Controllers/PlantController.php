<?php

namespace App\Http\Controllers;

// Hapus yang lama, ganti jadi ini:
use App\Models\Tip;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PlantController extends Controller
{
    // Tampilan Landing Page
    public function index() {
        $plants = Plant::all();
        return view('welcome', compact('plants'));
    }

    // Dashboard Admin dengan Fitur Filter RW
    public function dashboard(Request $request) {
    $query = Plant::query();

    // Fitur Filter RW
    if ($request->has('rw') && $request->rw != '') {
        $query->where('rw', $request->rw);
    }

    $plants = $query->get();
    $total_bibit = $query->sum('stok');
    $stok_menipis = $query->clone()->whereColumn('stok', '<=', 'min_stok')->count();
    
    // TAMBAHKAN BARIS INI untuk mengambil data tips dari database
    $tips = \App\Models\Tip::all(); 
    
    // MASUKKAN 'tips' ke dalam compact
    return view('dashboard', compact('plants', 'total_bibit', 'stok_menipis', 'tips'));
}

    public function create() {
        return view('tambah'); 
    }

    // Simpan data tanaman baru (Termasuk data RW)
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
            'rw'           => $request->rw, // Menyimpan pilihan RW
            'manfaat'      => $request->manfaat,
            'cara_olah'    => $request->cara_olah,
            'stok'         => $request->stok,
            'min_stok'     => 10,
            'slug'         => Str::slug($request->nama_tanaman)
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($id) {
        $plant = Plant::findOrFail($id);
        return view('edit', compact('plant'));
    }
public function update(Request $request, $id) {
        $plant = Plant::findOrFail($id);
        
        // Mengambil semua input dari form edit (termasuk stok, rw, manfaat, cara_olah)
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada file baru yang diunggah
            if ($plant->image && file_exists(public_path('images/plants/' . $plant->image))) {
                unlink(public_path('images/plants/' . $plant->image));
            }
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/plants'), $imageName);
            $data['image'] = $imageName;
        }

        // Update slug jika nama tanaman diganti
        $data['slug'] = Str::slug($request->nama_tanaman);
        
        // Perintah update ini akan otomatis mencocokkan nama input di form dengan kolom di database
        $plant->update($data);

        return redirect()->route('dashboard')->with('success', 'Berhasil diupdate!');
    }
    public function updateStock(Request $request, $id) {
        $plant = Plant::findOrFail($id);
        $plant->stok = $request->stok;
        $plant->save();
        return back();
    }

    public function destroy($id) {
        $plant = Plant::findOrFail($id);
        if ($plant->image && file_exists(public_path('images/plants/' . $plant->image))) {
            unlink(public_path('images/plants/' . $plant->image));
        }
        $plant->delete();
        return back();
    }

public function koleksi(Request $request) {
    $query = Plant::query();

    // Fitur Pencarian (Cari berdasarkan nama atau manfaat)
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_tanaman', 'like', '%' . $search . '%')
              ->orWhere('manfaat', 'like', '%' . $search . '%')
              ->orWhere('kategori', 'like', '%' . $search . '%');
        });
    }

    // Filter berdasarkan RW (Tetap ada)
    if ($request->has('rw') && $request->rw != '') {
        $query->where('rw', $request->rw);
    }

    $plants = $query->get();
    
    return view('koleksi', compact('plants'));
}

public function detail($slug) {
    $plant = Plant::where('slug', $slug)->firstOrFail();
    return view('detail', compact('plant'));
}
public function printLabel($id) {
    $plant = Plant::findOrFail($id);
    return view('print', compact('plant'));
}
public function Tips() {
    // Pastikan pakai Eloquent seperti ini agar jadi Object
    $tips = \App\Models\Tip::all(); 
    
    return view('tips', compact('tips'));
}

// Simpan Tips Baru
public function storeTip(Request $request) 
{
    // Ini cara paling aman biar gak error "MassAssignment"
    $tip = new \App\Models\Tip;
    $tip->judul = $request->judul;
    $tip->icon = $request->icon;
    $tip->tag = $request->tag;
    $tip->deskripsi = $request->deskripsi;
    $tip->save();

    return redirect()->back()->with('success', 'Tips Berhasil Ditambah!');
}

// Update Tips
public function updateTip(Request $request, $id) {
    $tip = Tip::findOrFail($id);
    $tip->update($request->all());
    return back()->with('success', 'Tips berhasil diperbarui!');
}

// Hapus Tips
public function destroyTip($id) {
    Tip::destroy($id);
    return back();
}
public function manageTips() {
    $tips = Tip::all();
    return view('admin.tips', compact('tips'));
}
public function cetakLaporan() {
    $plants = Plant::all();
    $total_bibit = Plant::sum('stok');
    $tanggal = date('d F Y');

    // Mengarahkan ke file blade khusus laporan
    $pdf = Pdf::loadView('admin.laporan_pdf', compact('plants', 'total_bibit', 'tanggal'));
    
    // Download otomatis dengan nama file tertentu
    return $pdf->download('Laporan_Stok_EcoHealth_'.date('Ymd').'.pdf');
}
}