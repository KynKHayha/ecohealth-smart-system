<form action="{{ route('plant.store') }}" method="POST" class="max-w-2xl mx-auto p-10 bg-white rounded-3xl shadow-xl mt-10">
    @csrf
    <h2 class="text-3xl font-black mb-8">Tambah Tanaman Baru</h2>
    <div class="space-y-4">
        <input type="text" name="nama_tanaman" placeholder="Nama Tanaman (Misal: Jahe Merah)" class="w-full p-4 bg-slate-100 rounded-2xl border-none">
        <input type="text" name="nama_latin" placeholder="Nama Latin" class="w-full p-4 bg-slate-100 rounded-2xl border-none">
        <select name="kategori" class="w-full p-4 bg-slate-100 rounded-2xl border-none">
            <option value="Hipertensi">Hipertensi</option>
            <option value="Asam Urat">Asam Urat</option>
            <option value="Diabetes">Diabetes</option>
        </select>
        <textarea name="manfaat" placeholder="Manfaat" class="w-full p-4 bg-slate-100 rounded-2xl border-none h-32"></textarea>
        <textarea name="cara_olah" placeholder="Cara Pengolahan" class="w-full p-4 bg-slate-100 rounded-2xl border-none h-32"></textarea>
        <input type="number" name="stok" placeholder="Jumlah Stok Awal" class="w-full p-4 bg-slate-100 rounded-2xl border-none">
        <button type="submit" class="w-full py-5 bg-emerald-600 text-white rounded-2xl font-black text-xl hover:bg-emerald-700 transition shadow-lg">Simpan ke Database</button>
    </div>
</form>