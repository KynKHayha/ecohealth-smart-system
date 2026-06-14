@extends('layouts.app')

@section('title', 'Koleksi Herbal | Eco Health Mekarjaya')
@section('meta_desc', 'Jelajahi koleksi tanaman obat TOGA yang dikelola warga Desa Mekarjaya.')

@section('content')
<div class="pt-20">
    {{-- ===== HEADER ===== --}}
    <header class="py-16 sm:py-24 px-4 sm:px-6 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto text-center" data-aos="fade-up">
            <div class="inline-flex px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-black uppercase tracking-widest mb-5">
                <span class="relative flex h-2 w-2 mr-2 mt-0.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Katalog Digital Desa
            </div>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tight mb-5 leading-tight">
                Koleksi <span class="text-emerald-600">Herbal</span><br class="hidden sm:block"> Mekarjaya
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-xl mx-auto font-medium">
                Apotek hidup yang dikelola secara gotong royong oleh warga di setiap wilayah.
            </p>
        </div>
    </header>

    {{-- ===== FILTER & SEARCH ===== --}}
    <div class="sticky top-16 z-30 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 py-4 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            {{-- Search --}}
            <form method="GET" action="{{ route('plant.koleksi') }}" class="flex-grow flex items-center">
                <div class="relative w-full">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama tanaman atau manfaat..."
                        class="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-sm font-medium text-slate-700 dark:text-slate-200 placeholder:text-slate-400 outline-none transition-all">
                </div>
            </form>

            {{-- RW Filter --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('plant.koleksi') }}"
                   class="px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ !request('rw') && !request('search') ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700' }}">
                    Semua
                </a>
                @foreach(['2','3','4'] as $rw)
                <a href="{{ route('plant.koleksi', ['rw' => $rw]) }}"
                   class="px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request('rw') == $rw ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700' }}">
                    RW 0{{ $rw }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== PLANT GRID ===== --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
        {{-- Result info --}}
        <div class="flex items-center justify-between mb-8">
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">
                Menampilkan <span class="font-black text-slate-900 dark:text-white">{{ $plants->count() }}</span> tanaman
                @if(request('rw')) di <span class="font-black text-emerald-600">RW 0{{ request('rw') }}</span>@endif
                @if(request('search')) untuk "<span class="font-black text-emerald-600">{{ request('search') }}</span>"@endif
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-6">
            @forelse($plants as $p)
            <a href="{{ route('plant.detail', $p->slug) }}"
               class="group block bg-white dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-700 hover:shadow-2xl hover:shadow-emerald-900/10 dark:hover:shadow-black/30 hover:-translate-y-2 transition-all duration-400"
               data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 60 }}">

                {{-- Image --}}
                <div class="relative h-48 sm:h-52 overflow-hidden bg-slate-100 dark:bg-slate-700">
                    <img src="{{ asset('images/plants/' . $p->image) }}" alt="{{ $p->nama_tanaman }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-600">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-400"></div>

                    {{-- Badges --}}
                    <div class="absolute top-3 left-3">
                        <span class="bg-emerald-500 text-white px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider">{{ $p->kategori }}</span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm text-slate-700 dark:text-slate-200 px-2.5 py-1 rounded-xl text-[10px] font-bold">RW 0{{ $p->rw }}</span>
                    </div>

                    {{-- Stock status overlay --}}
                    @if($p->stok <= 0)
                    <div class="absolute inset-0 bg-red-900/40 flex items-center justify-center">
                        <span class="bg-red-500 text-white px-4 py-1.5 rounded-full text-xs font-black uppercase">Stok Habis</span>
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-5">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition mb-1 leading-tight">{{ $p->nama_tanaman }}</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 italic text-xs font-medium mb-4">{{ $p->nama_latin }}</p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-1.5 h-1.5 rounded-full {{ $p->stok > 0 ? 'bg-emerald-500 animate-pulse' : 'bg-red-400' }}"></div>
                            <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400">{{ $p->stok }} bibit</span>
                        </div>
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center group-hover:bg-emerald-600 transition-all">
                            <svg class="w-4 h-4 text-emerald-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </div>
            </a>

            @empty
            <div class="col-span-full py-24 text-center" data-aos="fade-up">
                <div class="text-7xl mb-5">🔍</div>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">Tidak Ada Hasil</h3>
                <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-sm mx-auto">Belum ada tanaman untuk pencarian atau filter yang dipilih.</p>
                <a href="{{ route('plant.koleksi') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold hover:bg-emerald-700 transition">
                    Tampilkan Semua
                </a>
            </div>
            @endforelse
        </div>
    </main>
</div>
@endsection