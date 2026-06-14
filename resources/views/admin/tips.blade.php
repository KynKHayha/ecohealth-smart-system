@extends('layouts.admin')
@section('title', 'Manajemen Tips Kesehatan')

@section('content')
{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">💡 Tips Kesehatan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Kelola konten edukasi herbal untuk warga</p>
    </div>
    <button onclick="openModal()" class="flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-500/20 transition-all">
        + Tambah Tips Baru
    </button>
</div>

{{-- Tips Grid --}}
@if($tips->isEmpty())
<div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 p-16 text-center">
    <div class="text-6xl mb-4">💡</div>
    <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2">Belum Ada Tips</h3>
    <p class="text-slate-500 dark:text-slate-400 mb-6 text-sm">Tambahkan konten edukasi herbal untuk warga.</p>
    <button onclick="openModal()" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-500 transition">
        + Tambah Tips Pertama
    </button>
</div>
@else

{{-- Card grid preview --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
    @foreach($tips as $t)
    <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-700 shadow-sm group">
        {{-- Gambar / Icon --}}
        <div class="relative h-44 bg-slate-100 dark:bg-slate-700 overflow-hidden">
            @if($t->image)
                @php
                    $isUrl = str_starts_with($t->image, 'http://') || str_starts_with($t->image, 'https://');
                    $imgSrc = $isUrl ? $t->image : Storage::url($t->image);
                @endphp
                <img src="{{ $imgSrc }}" alt="{{ $t->judul }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @elseif($t->icon)
                <div class="w-full h-full flex items-center justify-center text-7xl bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20">
                    {{ $t->icon }}
                </div>
            @else
                <div class="w-full h-full flex items-center justify-center text-5xl text-slate-300 dark:text-slate-600">🌿</div>
            @endif

            {{-- Tag badge --}}
            <div class="absolute top-3 left-3">
                <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wide">{{ $t->tag }}</span>
            </div>
        </div>

        {{-- Konten --}}
        <div class="p-5">
            <h3 class="font-black text-slate-900 dark:text-white text-base mb-2 leading-tight">{{ $t->judul }}</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed line-clamp-2 mb-4">{{ $t->deskripsi }}</p>

            <form action="{{ route('tips.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus tips ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-2.5 bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 rounded-xl text-xs font-bold hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                    🗑️ Hapus Tips
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- ===== MODAL TAMBAH TIPS ===== --}}
<div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4" onclick="if(event.target===this)closeModal()">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"></div>
    <div class="relative bg-white dark:bg-slate-800 w-full max-w-xl rounded-3xl shadow-2xl border border-slate-100 dark:border-slate-700 max-h-[90vh] overflow-y-auto">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between p-7 border-b border-slate-100 dark:border-slate-700 sticky top-0 bg-white dark:bg-slate-800 z-10 rounded-t-3xl">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center text-2xl">💡</div>
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">Tambah Tips Baru</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">Konten Edukasi Herbal</p>
                </div>
            </div>
            <button onclick="closeModal()" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600 transition font-bold text-lg leading-none">✕</button>
        </div>

        <form action="{{ route('tips.store') }}" method="POST" enctype="multipart/form-data" class="p-7 space-y-5">
            @csrf

            {{-- Judul --}}
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Judul Tips *</label>
                <input type="text" name="judul" placeholder="Contoh: Manfaat Kunyit untuk Kesehatan" required
                    class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all">
            </div>

            {{-- Tag + Icon --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Kategori / Tag *</label>
                    <input type="text" name="tag" placeholder="Contoh: Herbal, Edukasi" required
                        class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Ikon Emoji <span class="normal-case font-medium">(opsional)</span></label>
                    <input type="text" name="icon" placeholder="🌿"
                        class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-center text-2xl outline-none transition-all">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Deskripsi / Isi Konten *</label>
                <textarea name="deskripsi" rows="3" placeholder="Jelaskan manfaat dan cara penggunaan secara singkat..." required
                    class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-600 dark:text-slate-300 outline-none resize-none transition-all"></textarea>
            </div>

            {{-- ===== BAGIAN GAMBAR ===== --}}
            <div class="bg-slate-50 dark:bg-slate-700/50 rounded-2xl p-5 border border-slate-200 dark:border-slate-600">
                <p class="text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-4">🖼️ Gambar Tips <span class="normal-case font-medium">(opsional — pilih salah satu)</span></p>

                {{-- Tab toggle --}}
                <div class="flex gap-2 mb-4">
                    <button type="button" id="tab-upload" onclick="switchTab('upload')"
                        class="flex-1 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all bg-emerald-600 text-white">
                        📁 Upload File
                    </button>
                    <button type="button" id="tab-url" onclick="switchTab('url')"
                        class="flex-1 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300">
                        🔗 Link URL
                    </button>
                </div>

                {{-- Upload file panel --}}
                <div id="panel-upload">
                    <div class="relative">
                        <input type="file" name="image_file" id="imageFile" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            onchange="previewImage(this)">
                        <div id="upload-box" class="border-2 border-dashed border-slate-300 dark:border-slate-500 rounded-2xl p-6 text-center hover:border-emerald-400 dark:hover:border-emerald-500 transition-all">
                            <div class="text-3xl mb-2">📷</div>
                            <p class="text-sm font-bold text-slate-600 dark:text-slate-300">Klik atau seret foto ke sini</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">JPG, PNG, WEBP • Maks. 2MB</p>
                        </div>
                        <img id="image-preview" class="hidden w-full h-40 object-cover rounded-2xl mt-3 border border-slate-200 dark:border-slate-600">
                    </div>
                </div>

                {{-- URL panel --}}
                <div id="panel-url" class="hidden">
                    <input type="url" name="image_url" id="imageUrl" placeholder="https://contoh.com/gambar.jpg"
                        oninput="previewUrl(this.value)"
                        class="w-full bg-white dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
                    <img id="url-preview" class="hidden w-full h-40 object-cover rounded-2xl mt-3 border border-slate-200 dark:border-slate-600">
                    <p id="url-error" class="hidden text-xs text-red-500 mt-2 font-medium">⚠️ Gambar tidak dapat dimuat. Pastikan URL valid dan bisa diakses.</p>
                </div>
            </div>

            {{-- Action buttons --}}
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal()" class="flex-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold py-3.5 rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-600 transition text-sm">Batal</button>
                <button type="submit" class="flex-[2] bg-emerald-600 hover:bg-emerald-500 text-white font-black py-3.5 rounded-2xl shadow-lg shadow-emerald-500/20 transition-all hover:scale-[1.02] text-sm">💾 Simpan Tips</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Modal
function openModal() {
    const m = document.getElementById('modal');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    const m = document.getElementById('modal');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}

// Tab switch Upload vs URL
function switchTab(tab) {
    const isUpload = tab === 'upload';

    document.getElementById('panel-upload').classList.toggle('hidden', !isUpload);
    document.getElementById('panel-url').classList.toggle('hidden', isUpload);

    const activeClass  = ['bg-emerald-600', 'text-white'];
    const inactiveClass = ['bg-slate-200', 'dark:bg-slate-600', 'text-slate-600', 'dark:text-slate-300'];

    const tabUpload = document.getElementById('tab-upload');
    const tabUrl    = document.getElementById('tab-url');

    if (isUpload) {
        tabUpload.classList.add(...activeClass);
        tabUpload.classList.remove(...inactiveClass);
        tabUrl.classList.remove(...activeClass);
        tabUrl.classList.add(...inactiveClass);
        // Kosongkan URL input
        document.getElementById('imageUrl').value = '';
    } else {
        tabUrl.classList.add(...activeClass);
        tabUrl.classList.remove(...inactiveClass);
        tabUpload.classList.remove(...activeClass);
        tabUpload.classList.add(...inactiveClass);
        // Reset file input
        document.getElementById('imageFile').value = '';
        document.getElementById('image-preview').classList.add('hidden');
    }
}

// Preview file upload
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            document.getElementById('upload-box').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Preview URL gambar
let urlTimer;
function previewUrl(url) {
    clearTimeout(urlTimer);
    const preview  = document.getElementById('url-preview');
    const errMsg   = document.getElementById('url-error');

    if (!url) {
        preview.classList.add('hidden');
        errMsg.classList.add('hidden');
        return;
    }

    urlTimer = setTimeout(() => {
        preview.src = url;
        preview.classList.remove('hidden');
        errMsg.classList.add('hidden');

        preview.onerror = () => {
            preview.classList.add('hidden');
            errMsg.classList.remove('hidden');
        };
    }, 600);
}
</script>
@endsection