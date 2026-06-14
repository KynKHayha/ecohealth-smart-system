@extends('layouts.app')

@section('title', 'Eco Health Smart System | Desa Mekarjaya')
@section('meta_desc', 'Platform digital manajemen TOGA, edukasi herbal, dan pemantauan kesehatan Desa Mekarjaya.')

@section('head')
<style>
    .hero-orb { animation: float 5s ease-in-out infinite; }
    .hero-orb-2 { animation: float 7s ease-in-out infinite reverse; }
    @keyframes float { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-20px) scale(1.02)} }
    .card-hover { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
    .card-hover:hover { transform: translateY(-10px); }
    .plant-img { transition: transform 0.6s cubic-bezier(0.34,1.56,0.64,1); }
    .plant-card:hover .plant-img { transform: scale(1.08); }
    .counter { font-variant-numeric: tabular-nums; }
</style>
@endsection

@section('content')
{{-- ===== HERO ===== --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-emerald-950 dark:bg-slate-900 pt-16">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-[0.04] bg-[url('https://www.transparenttextures.com/patterns/leaf.png')]"></div>

    {{-- Glowing orbs --}}
    <div class="hero-orb absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-emerald-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="hero-orb-2 absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-teal-400/10 rounded-full blur-[100px] pointer-events-none"></div>

    {{-- Grid line overlay --}}
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:60px 60px"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 text-center" data-aos="fade-up">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2.5 bg-white/8 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/15 mb-8">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-[11px] font-black text-emerald-300 uppercase tracking-[0.25em]">Digitalisasi Desa Mekarjaya</span>
        </div>

        {{-- Headline --}}
        <h1 class="text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-black text-white mb-6 leading-[0.95] tracking-tighter">
            Eco Health<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-300">
                Smart System
            </span>
        </h1>

        <p class="text-slate-300/80 text-lg sm:text-xl md:text-2xl mb-10 max-w-3xl mx-auto font-medium leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Satu platform untuk manajemen bibit TOGA, edukasi herbal, dan pemantauan kesehatan warga — berbasis digital secara real-time.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 sm:gap-4" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('plant.koleksi') }}" class="group flex items-center gap-3 bg-emerald-500 hover:bg-emerald-400 text-white px-7 py-4 rounded-2xl font-bold text-base shadow-2xl shadow-emerald-500/30 hover:shadow-emerald-400/40 hover:scale-105 transition-all duration-300">
                <span>🌿</span> Jelajahi Tanaman
                <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('plant.scan') }}" class="group flex items-center gap-3 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-7 py-4 rounded-2xl font-bold text-base border border-white/20 hover:border-white/40 hover:scale-105 transition-all duration-300">
                <span>📸</span> Scan QR
            </a>
            <a href="{{ route('login') }}" class="group flex items-center gap-3 bg-white/8 hover:bg-white/15 backdrop-blur-md text-white px-7 py-4 rounded-2xl font-bold text-base border border-white/15 hover:border-white/30 hover:scale-105 transition-all duration-300">
                <span>🔑</span> Admin
            </a>
        </div>

        {{-- Stats Bar --}}
        <div class="mt-16 flex flex-wrap justify-center gap-6 sm:gap-10" data-aos="fade-up" data-aos-delay="300">
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-black text-white counter">{{ $plants->count() }}+</div>
                <div class="text-[11px] text-emerald-400 font-bold uppercase tracking-widest mt-1">Spesies Tanaman</div>
            </div>
            <div class="w-px bg-white/10 hidden sm:block"></div>
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-black text-white counter">3</div>
                <div class="text-[11px] text-emerald-400 font-bold uppercase tracking-widest mt-1">Wilayah RW</div>
            </div>
            <div class="w-px bg-white/10 hidden sm:block"></div>
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-black text-white counter">100%</div>
                <div class="text-[11px] text-emerald-400 font-bold uppercase tracking-widest mt-1">Digital & Real-time</div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce opacity-40">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ===== FITUR UTAMA ===== --}}
<section class="py-20 sm:py-28 px-4 sm:px-6 bg-white dark:bg-slate-900" data-aos="fade-up">
    <div class="max-w-7xl mx-auto">
        {{-- Section header --}}
        <div class="text-center mb-14">
            <div class="inline-flex px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-black uppercase tracking-widest mb-4">Fitur Unggulan</div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tight mb-4">Teknologi <span class="text-emerald-600">Herbal</span> Masa Kini</h2>
            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-2xl mx-auto">Solusi lengkap pengelolaan tanaman obat dan edukasi kesehatan alami berbasis digital.</p>
        </div>

        {{-- Feature cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- QR Scan --}}
            <a href="{{ route('plant.scan') }}" class="card-hover group p-8 rounded-3xl border border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-emerald-600 dark:hover:bg-emerald-600 hover:border-emerald-600 hover:shadow-2xl hover:shadow-emerald-500/25 block" data-aos="fade-up" data-aos-delay="0">
                <div class="w-16 h-16 bg-white dark:bg-slate-700 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm transition-all duration-300">📸</div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white group-hover:text-white mb-3 transition">QR Code Terintegrasi</h3>
                <p class="text-slate-500 dark:text-slate-400 group-hover:text-emerald-50 text-sm leading-relaxed mb-6 transition">Scan kode unik tiap tanaman untuk akses info manfaat secara instan.</p>
                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 group-hover:text-white font-black text-sm transition">Scan Sekarang <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
            </a>

            {{-- Koleksi --}}
            <a href="{{ route('plant.koleksi') }}" class="card-hover group p-8 rounded-3xl border border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-emerald-600 dark:hover:bg-emerald-600 hover:border-emerald-600 hover:shadow-2xl hover:shadow-emerald-500/25 block" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-white dark:bg-slate-700 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm transition-all duration-300">📖</div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white group-hover:text-white mb-3 transition">Data Lengkap</h3>
                <p class="text-slate-500 dark:text-slate-400 group-hover:text-emerald-50 text-sm leading-relaxed mb-6 transition">Informasi komprehensif dari nama latin, dosis, hingga cara pengolahan.</p>
                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 group-hover:text-white font-black text-sm transition">Buka Koleksi <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
            </a>

            {{-- Tips --}}
            <a href="{{ route('plant.tips') }}" class="card-hover group p-8 rounded-3xl border border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-emerald-600 dark:hover:bg-emerald-600 hover:border-emerald-600 hover:shadow-2xl hover:shadow-emerald-500/25 block" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-white dark:bg-slate-700 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm transition-all duration-300">💡</div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white group-hover:text-white mb-3 transition">Tips Alami</h3>
                <p class="text-slate-500 dark:text-slate-400 group-hover:text-emerald-50 text-sm leading-relaxed mb-6 transition">Pelajari cara mengolah dan waktu terbaik mengonsumsi ramuan herbal.</p>
                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 group-hover:text-white font-black text-sm transition">Baca Tips <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
            </a>

            {{-- Tracking --}}
            <a href="{{ route('plant.tracking') }}" class="card-hover group p-8 rounded-3xl border border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-emerald-600 dark:hover:bg-emerald-600 hover:border-emerald-600 hover:shadow-2xl hover:shadow-emerald-500/25 block" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-white dark:bg-slate-700 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm transition-all duration-300">📍</div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white group-hover:text-white mb-3 transition">Greenhouse Track</h3>
                <p class="text-slate-500 dark:text-slate-400 group-hover:text-emerald-50 text-sm leading-relaxed mb-6 transition">Lacak posisi bibit di area greenhouse dengan pemetaan digital real-time.</p>
                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 group-hover:text-white font-black text-sm transition">Buka Peta <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
            </a>
        </div>
    </div>
</section>

{{-- ===== KATALOG PREVIEW ===== --}}
<section id="katalog" class="py-20 sm:py-28 px-4 sm:px-6 bg-slate-50 dark:bg-slate-950">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6" data-aos="fade-right">
            <div>
                <div class="inline-flex px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-black uppercase tracking-widest mb-4">Tanaman Pilihan</div>
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">Apotek Hidup<br><span class="text-emerald-600">Desa Mekarjaya</span></h2>
            </div>
            <a href="{{ route('plant.koleksi') }}" class="flex-shrink-0 group flex items-center gap-2 px-6 py-3.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-2xl font-bold text-sm hover:bg-emerald-600 dark:hover:bg-emerald-600 dark:hover:text-white transition-all">
                Lihat Semua <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($plants->take(3) as $p)
            <a href="{{ route('plant.detail', $p->slug) }}" class="plant-card group block bg-white dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-700 hover:shadow-2xl hover:shadow-emerald-900/10 dark:hover:shadow-black/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative overflow-hidden h-56 sm:h-64 bg-slate-100 dark:bg-slate-700">
                    <img src="{{ asset('images/plants/' . $p->image) }}" alt="{{ $p->nama_tanaman }}" class="plant-img w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-emerald-500 text-white px-3 py-1.5 rounded-xl text-[11px] font-black uppercase tracking-wider shadow">{{ $p->kategori }}</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm text-slate-700 dark:text-slate-300 px-3 py-1.5 rounded-xl text-[11px] font-bold shadow">RW 0{{ $p->rw }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-black text-slate-900 dark:text-white mb-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $p->nama_tanaman }}</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 font-medium italic text-sm mb-4">{{ $p->nama_latin }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full {{ $p->stok > 0 ? 'bg-emerald-500 animate-pulse' : 'bg-red-400' }}"></div>
                            <span class="text-xs font-bold text-slate-500 dark:text-slate-400">{{ $p->stok > 0 ? $p->stok . ' bibit tersedia' : 'Stok habis' }}</span>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CTA SECTION ===== --}}
<section class="py-20 px-4 sm:px-6 bg-white dark:bg-slate-900" data-aos="fade-up">
    <div class="max-w-4xl mx-auto text-center bg-emerald-950 dark:bg-emerald-900/20 dark:border dark:border-emerald-800/50 rounded-3xl p-10 sm:p-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(#10b981 1px,transparent 1px);background-size:28px 28px"></div>
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <div class="text-5xl mb-6">🌿</div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Punya Pertanyaan?</h2>
            <p class="text-emerald-100/60 text-lg mb-8 max-w-xl mx-auto">Kami siap membantu kamu mengenal lebih dalam manfaat tanaman obat di sekitarmu.</p>
            <a href="{{ route('kontak') }}" class="inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-400 text-white px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 transition-all shadow-xl shadow-emerald-900/40">
                📞 Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection