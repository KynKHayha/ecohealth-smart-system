<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Herbal Desa Mekarjaya | Eco Health</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
<style>
    body { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
    }
    .bg-soft-matte {
        background-color: #f0f4f2; /* Pakai yang Opsi 1 */
        min-height: 100vh;
    }
    /* Pastikan Card-nya Putih Bersih */
    .card-style {
        background-color: #ffffff;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .glass-nav {
        background: rgba(241, 245, 249, 0.8); /* Menyesuaikan bg baru */
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    .card-shadow {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 50px -12px rgba(15, 23, 42, 0.1); /* Shadow lebih gelap dan dalam */
    }
</style>
</head>
<body class="bg-soft-matte min-h-screen text-slate-800">

    <nav class="sticky top-0 z-50 glass-nav border-b border-slate-200/60 p-5">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('index') }}" class="flex items-center gap-2 group">
                <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
                <span class="font-800 text-xl tracking-tighter text-slate-900">EcoHealth</span>
            </a>
            <a href="{{ route('index') }}" class="px-5 py-2 rounded-full bg-slate-200/50 text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-emerald-600 hover:text-white transition-all">← Beranda</a>
        </div>
    </nav>

    <header class="pt-20 pb-16 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-900/5 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-8 border border-emerald-900/10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Katalog Digital Desa
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-[0.9]">
                Koleksi <span class="text-emerald-700">Herbal</span> <br>Mekarjaya
            </h1>
            <p class="text-lg text-slate-500 max-w-xl mx-auto font-medium leading-relaxed">
                Jelajahi apotek hidup yang dikelola secara gotong royong oleh warga di setiap wilayah.
            </p>
        </div>
    </header>
    <section class="max-w-7xl mx-auto px-6 mb-16">
        <div class="bg-white/60 backdrop-blur-md p-2 rounded-[2.5rem] border border-white shadow-xl shadow-slate-200/50 flex flex-wrap justify-center gap-2">
            <a href="{{ route('plant.koleksi') }}" 
               class="px-8 py-4 rounded-[2rem] font-bold text-sm transition-all duration-300 {{ !request('rw') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-white hover:shadow-sm' }}">
               🌏 Semua Wilayah
            </a>
            @foreach(['2', '3', '4'] as $rw)
            <a href="{{ route('plant.koleksi', ['rw' => $rw]) }}" 
               class="px-8 py-4 rounded-[2rem] font-bold text-sm transition-all duration-300 {{ request('rw') == $rw ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-white hover:shadow-sm' }}">
               📍 RW 0{{ $rw }}
            </a>
            @endforeach
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 pb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($plants as $p)
            <div class="group card-hover bg-white rounded-[3.5rem] p-4 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-emerald-900/10 transition-all duration-500">
                <div class="relative h-80 rounded-[2.8rem] overflow-hidden mb-6 shadow-inner bg-slate-100">
                    <img src="{{ asset('images/plants/' . $p->image) }}" class="w-full h-full object-cover transition duration-700">
                    
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-2xl shadow-sm border border-white/50">
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-tighter">Unit Lokasi</p>
                        <p class="text-sm font-bold text-slate-900">RW 0{{ $p->rw }}</p>
                    </div>

                    <div class="absolute bottom-4 left-4">
                        <span class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg">
                            {{ $p->kategori }}
                        </span>
                    </div>
                </div>

                <div class="px-4 pb-6">
                    <h3 class="text-3xl font-800 text-slate-900 leading-none mb-2 group-hover:text-emerald-600 transition">{{ $p->nama_tanaman }}</h3>
                    <p class="text-slate-400 font-medium italic text-lg mb-6 leading-none">{{ $p->nama_latin }}</p>
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex-1">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Status Stok</p>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full {{ $p->stok > 0 ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></div>
                                <span class="text-sm font-bold text-slate-700">{{ $p->stok }} Bibit Tersedia</span>
                            </div>
                        </div>
                        <a href="{{ route('plant.detail', $p->slug) }}" 
                           class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:rotate-[360deg] transition-all duration-700 shadow-xl shadow-slate-900/20">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                           </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl">🔍</div>
                <h3 class="text-3xl font-black text-slate-900">Belum Ada Data</h3>
                <p class="text-slate-400 font-medium max-w-sm mx-auto mt-2 italic">Wah, sepertinya belum ada koleksi tanaman obat untuk wilayah ini.</p>
                <a href="{{ route('plant.koleksi') }}" class="inline-block mt-8 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-emerald-600 transition shadow-lg">Lihat Semua Tanaman</a>
            </div>
            @endforelse
        </div>
    </main>

</body>
</html>