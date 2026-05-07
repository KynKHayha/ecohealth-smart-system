<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Tanaman | Admin</title>
</head>
<body class="bg-slate-50 p-12">
    <div class="max-w-3xl mx-auto bg-white p-10 rounded-[3rem] shadow-2xl border border-slate-100">
        <h1 class="text-3xl font-black text-slate-900 mb-8">🌿 Input Tanaman Baru</h1>
        
        <form action="{{ route('plant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="mb-6">
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Upload Foto Tanaman</label>
                <div class="relative group">
                    <input type="file" name="image" accept="image/*" required
                        class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-8 text-center cursor-pointer hover:border-emerald-500 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">Nama Tanaman</label>
                    <input type="text" name="nama_tanaman" required class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">Nama Latin</label>
                    <input type="text" name="nama_latin" required class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Kategori Khasiat</label>
                <select name="kategori" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500">
                    <option value="Hipertensi">Hipertensi</option>
                    <option value="Asam Urat">Asam Urat</option>
                    <option value="Diabetes">Diabetes</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Manfaat Khasiat</label>
                <textarea name="manfaat" placeholder="Contoh: Menurunkan kadar gula darah..." required 
                    class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 h-32"></textarea>
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Cara Pengolahan</label>
                <textarea name="cara_olah" placeholder="Contoh: Rebus 5 lembar daun dengan 2 gelas air..." required 
                    class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 h-32"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">Stok Awal</label>
                    <input type="number" name="stok" value="0" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">Minimal Stok</label>
                    <input type="number" name="min_stok" value="10" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>
            <div class="mb-4">
    <label class="block text-sm font-bold mb-2">Pilih Wilayah RW</label>
    <select name="rw" required class="w-full p-4 bg-slate-50 rounded-2xl border-none">
        <option value="">-- Pilih RW --</option>
        <option value="2">RW 02</option>
        <option value="3">RW 03</option>
        <option value="4">RW 04</option>
    </select>
</div>

            <button type="submit" class="w-full bg-emerald-600 text-white py-5 rounded-[2rem] font-black text-xl shadow-xl hover:scale-[1.02] transition-all">
                Simpan Tanaman
            </button>
        </form>
    </div>
</body>
</html>