<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tanaman | Eco Health</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 md:p-12">

    <div class="w-full max-w-4xl bg-white rounded-[3rem] shadow-2xl shadow-emerald-900/10 overflow-hidden border border-slate-100">
        <div class="bg-emerald-600 p-10 text-white text-center">
            <h1 class="text-3xl font-800 tracking-tight">✏️ Edit Data Tanaman</h1>
            <p class="opacity-80 font-medium mt-1">Sesuaikan informasi tanaman obat untuk wilayah RW</p>
        </div>

        <form action="{{ route('plant.update', $plant->id) }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Nama Tanaman</label>
                    <input type="text" name="nama_tanaman" value="{{ $plant->nama_tanaman }}" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Nama Latin (Ilmiah)</label>
                    <input type="text" name="nama_latin" value="{{ $plant->nama_latin }}" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 italic">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Kategori Khasiat</label>
                    <select name="kategori" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                        <option value="Hipertensi" {{ $plant->kategori == 'Hipertensi' ? 'selected' : '' }}>Hipertensi</option>
                        <option value="Diabetes" {{ $plant->kategori == 'Diabetes' ? 'selected' : '' }}>Diabetes</option>
                        <option value="Asam Urat" {{ $plant->kategori == 'Asam Urat' ? 'selected' : '' }}>Asam Urat</option>
                        <option value="Lainnya" {{ $plant->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Wilayah RW</label>
                    <select name="rw" required class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 font-bold text-emerald-600">
                        <option value="2" {{ $plant->rw == '2' ? 'selected' : '' }}>RW 02</option>
                        <option value="3" {{ $plant->rw == '3' ? 'selected' : '' }}>RW 03</option>
                        <option value="4" {{ $plant->rw == '4' ? 'selected' : '' }}>RW 04</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Jumlah Stok Bibit</label>
                    <input type="number" name="stok" value="{{ $plant->stok }}" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Manfaat Detail</label>
                    <textarea name="manfaat" rows="4" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 font-medium">{{ $plant->manfaat }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Cara Pengolahan</label>
                    <textarea name="cara_olah" rows="4" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 font-medium">{{ $plant->cara_olah }}</textarea>
                </div>
            </div>

            <div class="bg-slate-50 p-6 rounded-[2rem] border-2 border-dashed border-slate-200">
                <label class="block text-xs font-black uppercase text-slate-400 mb-4 tracking-widest">Foto Tanaman Saat Ini</label>
                <div class="flex items-center gap-6">
                    @if($plant->image)
                        <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
                    @else
                        <div class="w-24 h-24 bg-slate-200 rounded-2xl flex items-center justify-center text-3xl">🌿</div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 transition cursor-pointer">
                        <p class="text-[10px] text-slate-400 mt-2">*Biarkan kosong jika tidak ingin mengganti foto</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('dashboard') }}" class="flex-1 text-center py-4 bg-slate-100 text-slate-500 rounded-2xl font-800 hover:bg-slate-200 transition">Batal</a>
                <button type="submit" class="flex-[2] py-4 bg-emerald-600 text-white rounded-2xl font-800 shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>