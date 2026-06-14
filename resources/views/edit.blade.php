@extends('layouts.admin')
@section('title', 'Edit Tanaman')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('dashboard') }}" class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">✏️ Edit Tanaman</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Mengubah data: <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $plant->nama_tanaman }}</span></p>
        </div>
    </div>

    <form action="{{ route('plant.update', $plant->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Image --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm">
            <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-4">📸 Foto Tanaman</label>
            <div class="flex items-center gap-5 flex-wrap">
                @if($plant->image)
                <div class="relative">
                    <img id="current-preview" src="{{ asset('images/plants/' . $plant->image) }}" alt="Foto saat ini" class="w-28 h-28 rounded-2xl object-cover border-2 border-emerald-200 dark:border-emerald-700">
                    <span class="absolute -top-2 -right-2 bg-emerald-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">Saat ini</span>
                </div>
                @endif
                <div class="flex-grow">
                    <input type="file" name="image" accept="image/*" onchange="previewNewImage(this)"
                        class="block w-full text-sm text-slate-500 dark:text-slate-400
                            file:mr-4 file:py-2.5 file:px-5
                            file:rounded-xl file:border-0
                            file:text-xs file:font-bold
                            file:bg-emerald-600 file:text-white
                            hover:file:bg-emerald-500
                            file:transition-all file:cursor-pointer cursor-pointer">
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-2">* Biarkan kosong jika tidak ingin mengganti foto</p>
                    <img id="new-preview" class="hidden mt-3 w-28 h-28 rounded-2xl object-cover border-2 border-blue-200">
                </div>
            </div>
        </div>

        {{-- Basic Info --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm space-y-5">
            <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest border-b border-slate-100 dark:border-slate-700 pb-4">Informasi Dasar</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Nama Tanaman *</label>
                    <input type="text" name="nama_tanaman" value="{{ $plant->nama_tanaman }}" required
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Nama Latin</label>
                    <input type="text" name="nama_latin" value="{{ $plant->nama_latin }}" required
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm italic font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                    <select name="kategori" class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all appearance-none">
                        @foreach(['Hipertensi','Diabetes','Asam Urat','Lainnya'] as $kat)
                        <option value="{{ $kat }}" {{ $plant->kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Wilayah RW</label>
                    <select name="rw" required class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all appearance-none">
                        @foreach(['2'=>'RW 02','3'=>'RW 03','4'=>'RW 04'] as $val => $label)
                        <option value="{{ $val }}" {{ $plant->rw == $val ? 'selected' : '' }}>📍 {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Stok Bibit</label>
                    <input type="number" name="stok" value="{{ $plant->stok }}" required min="0"
                        class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm space-y-5">
            <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest border-b border-slate-100 dark:border-slate-700 pb-4">Deskripsi</h3>
            <div>
                <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Manfaat & Khasiat</label>
                <textarea name="manfaat" rows="4" required
                    class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all resize-none">{{ $plant->manfaat }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Cara Pengolahan</label>
                <textarea name="cara_olah" rows="4" required
                    class="w-full bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all resize-none">{{ $plant->cara_olah }}</textarea>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3 pb-4">
            <a href="{{ route('dashboard') }}" class="flex-1 text-center py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-2xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition">Batal</a>
            <button type="submit" class="flex-[2] py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black shadow-xl shadow-emerald-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                ✅ Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function previewNewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('new-preview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection