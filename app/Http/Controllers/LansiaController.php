<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use App\Models\Plant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LansiaController extends Controller {
    
    public function index() {
        $lansias = Lansia::all();
        // Ambil data tanaman untuk pengecekan stok otomatis
        $plants = Plant::all(); 
        return view('admin.lansia.index', compact('lansias', 'plants'));
    }

    // FUNGSI IMPORT DATA DARI CSV
    public function import(Request $request) 
{
    // 1. Validasi: Pastikan ada file yang di-upload
    $request->validate([
        'file_csv' => 'required|mimes:csv,txt'
    ]);

    // 2. Ambil file dari request
    $fileUploaded = $request->file('file_csv');
    $file = fopen($fileUploaded->getRealPath(), 'r');
    $count = 0;

    // 3. Proses baca seperti biasa
    while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
        if (!isset($row[1]) || empty(trim($row[1])) || trim($row[1]) == 'Nama Lansia') {
            continue;
        }

        $nikBersih = preg_replace('/[^0-9]/', '', $row[2] ?? uniqid());

        \App\Models\Lansia::updateOrCreate(
            ['nik' => $nikBersih], 
            [
                'nama'     => trim($row[1]),
                'alamat'   => trim($row[3] ?? 'Mekarjaya'),
                'penyakit' => trim($row[4] ?? 'tidak ada'),
                'rw'       => 3, 
            ]
        );
        $count++;
    }
    
    fclose($file);
    return redirect()->back()->with('success', $count . ' Data Berhasil Diimpor!');
}
    // FUNGSI CETAK KARTU SEHAT PDF
    public function cetakKartu($id)
{
    $lansia = \App\Models\Lansia::findOrFail($id);
    $tanggal = now()->format('d F Y');
    
    // Logika rekomendasi herbal (sesuaikan dengan kode kamu)
    $saran = "Belum ada saran khusus";
    if (stripos($lansia->penyakit, 'hipertensi') !== false) $saran = "Sambiloto / Kumis Kucing (Rebus 3 lembar daun)";
    if (stripos($lansia->penyakit, 'asam urat') !== false) $saran = "Jahe / Daun Salam (Seduh dengan air hangat)";

    // AMBIL QR CODE SEBAGAI BASE64 (Biar nggak silang lagi)
    $url = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" . $lansia->nik;
    $imageData = base64_encode(file_get_contents($url));
    $qrCode = 'data:image/png;base64,' . $imageData;

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.lansia.kartu_pdf', compact('lansia', 'tanggal', 'saran', 'qrCode'));
    return $pdf->stream('Kartu-Sehat-' . $lansia->nama . '.pdf');
}
    public function destroy($id)
{
    // Cari data berdasarkan ID, kalau gak ada muncul error 404
    $lansia = \App\Models\Lansia::findOrFail($id);
    
    // Hapus datanya
    $lansia->delete();

    // Balik lagi ke halaman tadi dengan pesan sukses
    return redirect()->route('lansia.index')->with('success', 'Data berhasil dihapus!');
}
    public function store(Request $request)
{
    // 1. Validasi inputan biar gak ada data kosong
    $request->validate([
        'nama' => 'required',
        'nik' => 'required|unique:lansias,nik',
        'penyakit' => 'required',
        'alamat' => 'required',
        'rw' => 'required'
    ]);

    // 2. Simpan data ke database
    \App\Models\Lansia::create([
        'nama' => $request->nama,
        'nik' => $request->nik,
        'penyakit' => $request->penyakit,
        'alamat' => $request->alamat,
        'rw' => $request->rw,
    ]);

    // 3. Balik ke halaman utama dengan pesan sukses
    return redirect()->route('lansia.index')->with('success', 'Data warga baru berhasil ditambahkan!');
}
public function truncate()
{
    // Perintah sakti untuk mengosongkan seluruh isi tabel
    \App\Models\Lansia::truncate();

    return redirect()->route('lansia.index')->with('success', 'Seluruh data lansia telah dibersihkan!');
}
public function bulkDelete(Request $request)
{
    $ids = explode(',', $request->ids);
    \App\Models\Lansia::whereIn('id', $ids)->delete();

    return back()->with('success', count($ids) . ' Data warga berhasil dihapus!');
}
// Hapus data yang baru saja di-input manual (5 menit terakhir)
public function deleteRecentManual()
{
    \App\Models\Lansia::where('created_at', '>=', now()->subMinutes(5))->delete();
    return back()->with('success', 'Data inputan manual terbaru berhasil dibersihkan!');
}

// Hapus data yang baru saja di-import (Kloter terakhir)
// Tips: Kita hapus berdasarkan waktu created_at yang sama persis saat import
public function deleteRecentImport()
{
    $lastImportTime = \App\Models\Lansia::max('created_at');
    if ($lastImportTime) {
        \App\Models\Lansia::where('created_at', $lastImportTime)->delete();
        return back()->with('success', 'Data hasil import terakhir berhasil dibersihkan!');
    }
    return back()->with('error', 'Tidak ada data import ditemukan.');
}
}