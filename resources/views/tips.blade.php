@extends('layouts.app')
@section('title', 'Tips Kesehatan Alami | EcoHealth Mekarjaya')

@section('content')
<div class="pt-20">
    {{-- Header --}}
    <header class="py-16 sm:py-24 px-4 sm:px-6 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 text-center">
        <div class="max-w-4xl mx-auto" data-aos="fade-up">
            <div class="inline-flex px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-black uppercase tracking-widest mb-5">Informasi Edukasi</div>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tight mb-5 leading-tight">
                Tips Kesehatan<br><span class="text-emerald-600">Alami & Tradisional</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-xl mx-auto">Kearifan lokal yang terbukti manjur, dikemas secara digital untuk warga Mekarjaya.</p>
        </div>
    </header>

    {{-- Tips List --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-24 space-y-16 sm:space-y-28">
        @forelse($tips as $index => $tip)

        @php
            // Tentukan sumber gambar
            $hasImage = !empty($tip->image);
            $isUrl = $hasImage && (str_starts_with($tip->image, 'http://') || str_starts_with($tip->image, 'https://'));
            $imgSrc = $hasImage ? ($isUrl ? $tip->image : Storage::url($tip->image)) : null;
        @endphp

        <div class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-8 sm:gap-14"
             data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">

            {{-- Gambar atau Icon --}}
            <div class="flex-shrink-0">
                @if($imgSrc)
                    {{-- Tampilkan gambar (upload atau URL) --}}
                    <div class="w-64 h-64 sm:w-72 sm:h-72 rounded-[3rem] overflow-hidden shadow-2xl dark:shadow-black/30 border border-slate-100 dark:border-slate-700 bg-slate-100 dark:bg-slate-800">
                        <img src="{{ $imgSrc }}" alt="{{ $tip->judul }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    </div>
                @else
                    {{-- Fallback: tampilkan emoji icon --}}
                    <div class="w-44 h-44 sm:w-56 sm:h-56 bg-white dark:bg-slate-800 rounded-[3rem] shadow-2xl dark:shadow-black/30 border border-slate-100 dark:border-slate-700 flex items-center justify-center text-7xl sm:text-8xl hover:scale-105 transition duration-500">
                        {{ $tip->icon ?: '🌿' }}
                    </div>
                @endif
            </div>

            {{-- Teks Konten --}}
            <div class="flex-1 text-center md:text-left">
                <span class="inline-block bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4">{{ $tip->tag }}</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-5 leading-tight">{{ $tip->judul }}</h2>
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed font-medium max-w-lg mx-auto md:mx-0">{{ $tip->deskripsi }}</p>
            </div>
        </div>

        @if(!$loop->last)
        <div class="flex items-center gap-4">
            <div class="flex-grow h-px bg-slate-100 dark:bg-slate-800"></div>
            <span class="text-2xl">🌿</span>
            <div class="flex-grow h-px bg-slate-100 dark:bg-slate-800"></div>
        </div>
        @endif

        @empty
        <div class="text-center py-20" data-aos="fade-up">
            <div class="text-6xl mb-5">💡</div>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">Belum Ada Tips</h3>
            <p class="text-slate-500 dark:text-slate-400">Admin sedang menyiapkan konten edukasi untuk Anda.</p>
        </div>
        @endforelse
    </main>

    {{-- CTA Banner --}}
    <section class="px-4 sm:px-6 pb-20 sm:pb-28">
        <div class="max-w-4xl mx-auto bg-slate-900 dark:bg-slate-800 rounded-3xl p-10 sm:p-16 text-center text-white relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(#10b981 1px,transparent 1px);background-size:28px 28px"></div>
            <div class="relative z-10">
                <h2 class="text-3xl sm:text-4xl font-black mb-4 tracking-tight">Punya Pengetahuan Herbal?</h2>
                <p class="text-slate-400 text-lg mb-8 max-w-xl mx-auto">Mari gotong royong lestarikan budaya leluhur. Bagikan tips kesehatanmu kepada kader RW.</p>
                <a href="https://wa.me/6281281954124?text=Hallo%20Admin%20mekarjaya%2C%20saya%20mau%20saran%20tips%20kesehatan%20nih"
                   target="_blank"
                   class="inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-400 text-white px-8 py-4 rounded-2xl font-bold hover:scale-105 transition-all shadow-xl">
                    💬 Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </section>
</div>
@endsection