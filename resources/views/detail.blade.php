@extends('layouts.app')

@section('title', $plant->nama_tanaman . ' | EcoHealth Mekarjaya')
@section('meta_desc', 'Informasi lengkap tentang ' . $plant->nama_tanaman . ' — manfaat, cara pengolahan, dan stok bibit di Desa Mekarjaya.')

@section('content')
<div class="pt-16">
    {{-- ===== HERO IMAGE ===== --}}
    <div class="relative min-h-[60vh] sm:min-h-[70vh] flex items-end overflow-hidden bg-slate-900">
        <img src="{{ asset('images/plants/' . $plant->image) }}"
             alt="{{ $plant->nama_tanaman }}"
             class="absolute inset-0 w-full h-full object-cover opacity-50 scale-105"
             style="filter: blur(2px)">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-slate-900/20"></div>

        {{-- Back btn --}}
        <a href="{{ route('plant.koleksi') }}" class="absolute top-6 left-4 sm:left-6 z-10 group flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm transition-all hover:scale-105">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Koleksi
        </a>

        {{-- Hero Text --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 pb-10 sm:pb-16 w-full">
            <span class="inline-block bg-emerald-500 text-white px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-widest mb-4 shadow-lg">
                {{ $plant->kategori }}
            </span>
            <h1 class="text-5xl sm:text-7xl md:text-8xl font-black text-white tracking-tighter leading-none mb-3">
                {{ $plant->nama_tanaman }}
            </h1>
            <p class="text-2xl sm:text-3xl text-emerald-300 italic font-medium">{{ $plant->nama_latin }}</p>
        </div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Left: Main Info --}}
                <div class="lg:col-span-8 space-y-6" data-aos="fade-up">

                    {{-- Manfaat --}}
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 sm:p-10 border border-slate-100 dark:border-slate-700 shadow-sm">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">✨</div>
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Khasiat & Manfaat</h2>
                        </div>
                        <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed">{{ $plant->manfaat }}</p>
                    </div>

                    {{-- Cara Olah --}}
                    <div class="bg-slate-900 dark:bg-emerald-950 rounded-3xl p-8 sm:p-10 text-white relative overflow-hidden group">
                        <div class="absolute -right-8 -bottom-8 text-[12rem] opacity-5 group-hover:rotate-12 group-hover:scale-110 transition duration-700 select-none pointer-events-none">🍵</div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6 text-emerald-400">
                                <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center">🍵</div>
                                <span class="text-xs font-black uppercase tracking-widest">Cara Pengolahan Aman</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black mb-6 leading-tight">Bagaimana cara<br>mengonsumsinya?</h2>
                            <p class="text-slate-300 text-lg leading-relaxed font-medium">{{ $plant->cara_olah }}</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Sidebar --}}
                <div class="lg:col-span-4 space-y-5" data-aos="fade-up" data-aos-delay="100">

                    {{-- Lokasi --}}
                    <div class="bg-emerald-600 rounded-3xl p-7 text-white">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-100/70 mb-1">Lokasi Budidaya</p>
                        <h3 class="text-3xl font-black mb-4">RW 0{{ $plant->rw }}<br><span class="text-xl font-bold text-emerald-100">Desa Mekarjaya</span></h3>
                        <div class="h-0.5 w-12 bg-emerald-400 mb-4"></div>
                        <p class="text-emerald-50/80 text-sm leading-relaxed">Ditanam dan dirawat secara kolektif oleh warga RW 0{{ $plant->rw }}.</p>
                    </div>

                    {{-- Stok --}}
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Stok Saat Ini</p>
                        <div class="flex items-end justify-between mb-5">
                            <h4 class="text-5xl font-black text-slate-900 dark:text-white">{{ $plant->stok }} <span class="text-base font-bold text-slate-400 uppercase">Bibit</span></h4>
                            <span class="text-3xl">🌱</span>
                        </div>
                        @if($plant->stok > $plant->min_stok)
                        <div class="bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800/50 rounded-2xl py-3 flex items-center justify-center gap-2 font-black text-xs uppercase tracking-widest">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Bibit Tersedia
                        </div>
                        @elseif($plant->stok > 0)
                        <div class="bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-800/50 rounded-2xl py-3 flex items-center justify-center gap-2 font-black text-xs uppercase tracking-widest">
                            ⚠️ Stok Menipis
                        </div>
                        @else
                        <div class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800/50 rounded-2xl py-3 flex items-center justify-center gap-2 font-black text-xs uppercase tracking-widest">
                            ❌ Stok Habis
                        </div>
                        @endif
                    </div>

                    {{-- QR Code --}}
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 text-center">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">QR Code Digital</p>
                        <div class="inline-block p-3 bg-white rounded-2xl shadow-inner border border-slate-100 mb-4">
                            {!! QrCode::size(140)->eye('circle')->color(5, 150, 105)->generate(route('plant.detail', $plant->slug)) !!}
                        </div>
                        <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">Scan untuk akses instan di lokasi kebun</p>
                    </div>

                    {{-- Back CTA --}}
                    <a href="{{ route('plant.koleksi') }}" class="group flex items-center justify-center gap-2 w-full py-4 bg-slate-900 dark:bg-slate-700 text-white rounded-2xl font-bold text-sm hover:bg-emerald-600 transition-all">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Koleksi
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection