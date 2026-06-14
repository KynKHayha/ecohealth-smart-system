@extends('layouts.admin')
@section('title', 'Tambah Tanaman Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('dashboard') }}" class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">🌿 Tambah Tanaman Baru</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Input data tanaman obat untuk katalog desa</p>
        </div>
    </div>

    <form action="{{ route('plant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Upload Image --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm">
            <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-4">📸 Foto Tanaman</label>
            <div class="relative group">
                <input type="file" name="image" id="imageInput" accept="image/*" required
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                    onchange="previewImage(this)">
                <div id="upload-placeholder" class="border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-2xl p-10 text-center hover:border-emerald-400 dark:hover:border-emerald-500 transition-all">
                    <div class="text-4xl mb-3">📷</div>
                    <p class="font-bold text-slate-600 dark:text-slate-300 text-sm">Klik atau seret foto ke sini</p>
                    <p class="text-slate-400 dark:text-slate-500 text-xs mt-1">JPG, PNG, WEBP (maks. 5MB)</p>
                </div>
                <img id="image-preview" class="hidden w-full h-52 object-cover rounded-2xl">
            </div>
        </div>

        {{-- Basic Info --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm space-y-5">
            <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest border-b border-slate-100 dark:border-slate-700 pb-4">Informasi Dasar</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Nama Tanaman *</label>
                    <input type="text" name="nama_tanaman" required placeholder="Contoh: Kumis Kucing"
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Nama Latin *</label>
                    <input type="text" name="nama_latin" required placeholder="Contoh: Orthosiphon aristatus"
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm italic font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Kategori Khasiat *</label>
                    <select name="kategori" class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all appearance-none">
                        <option value="Hipertensi">🫀 Hipertensi</option>
                        <option value="Asam Urat">🦴 Asam Urat</option>
                        <option value="Diabetes">🩸 Diabetes</option>
                        <option value="Lainnya">🌿 Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Wilayah RW *</label>
                    <select name="rw" required class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all appearance-none">
                        <option value="">-- Pilih RW --</option>
                        <option value="2">📍 RW 02</option>
                        <option value="3">📍 RW 03</option>
                        <option value="4">📍 RW 04</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm space-y-5">
            <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest border-b border-slate-100 dark:border-slate-700 pb-4">Deskripsi Tanaman</h3>
            <div>
                <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Manfaat & Khasiat *</label>
                <textarea name="manfaat" required rows="4" placeholder="Jelaskan manfaat tanaman ini untuk kesehatan..."
                    class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Cara Pengolahan *</label>
                <textarea name="cara_olah" required rows="4" placeholder="Contoh: Rebus 5 lembar daun dengan 2 gelas air hingga tersisa 1 gelas..."
                    class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all resize-none"></textarea>
            </div>
        </div>

        {{-- Stok --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm">
            <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest border-b border-slate-100 dark:border-slate-700 pb-4 mb-5">Stok Bibit</h3>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Stok Awal</label>
                    <input type="number" name="stok" value="0" min="0"
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Batas Stok Minimum</label>
                    <input type="number" name="min_stok" value="10" min="1"
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 pb-4">
            <a href="{{ route('dashboard') }}" class="flex-1 text-center py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-2xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition">Batal</a>
            <button type="submit" class="flex-[2] py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black shadow-xl shadow-emerald-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                💾 Simpan Tanaman
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('upload-placeholder').classList.add('hidden');
            const preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection