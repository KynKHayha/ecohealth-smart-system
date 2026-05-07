<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $plant->nama_tanaman }} | EcoHealth Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .hero-mask {
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="antialiased">

    <nav class="fixed top-0 left-0 right-0 z-50 p-6 flex justify-between items-center transition-all duration-300">
        <a href="{{ route('plant.koleksi') }}" class="group flex items-center gap-3 bg-white/90 backdrop-blur-md px-6 py-3 rounded-full shadow-xl shadow-slate-900/10 border border-slate-200">
            <span class="group-hover:-translate-x-1 transition duration-300">←</span>
            <span class="text-sm font-black text-slate-900 uppercase tracking-widest">Koleksi</span>
        </a>
    </nav>

    <div class="relative w-full min-h-[70vh] flex items-center justify-center overflow-hidden bg-slate-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/plants/' . $plant->image) }}" class="w-full h-full object-cover opacity-60 scale-105 blur-[2px]">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 pt-20 text-center">
            <span class="inline-block px-6 py-2 bg-emerald-500 text-white rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-8 shadow-2xl shadow-emerald-500/50">
                Kategori: {{ $plant->kategori }}
            </span>
            <h1 class="text-7xl md:text-9xl font-black text-white tracking-tighter leading-none mb-4">
                {{ $plant->nama_tanaman }}
            </h1>
            <p class="text-2xl md:text-3xl italic text-emerald-300 font-medium tracking-tight">
                {{ $plant->nama_latin }}
            </p>
        </div>
    </div>

    <main class="relative z-20 -mt-24 max-w-6xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-8 space-y-10">
                
                <div class="bg-white rounded-[4rem] p-12 shadow-2xl shadow-slate-200 border border-slate-100">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">✨</div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tighter">Khasiat & Manfaat</h2>
                    </div>
                    <p class="text-xl text-slate-600 leading-relaxed font-medium">
                        {{ $plant->manfaat }}
                    </p>
                </div>

                <div class="bg-slate-900 rounded-[4rem] p-12 text-white shadow-2xl shadow-emerald-900/40 relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 text-[15rem] opacity-5 group-hover:rotate-12 transition duration-700">🍵</div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-8 text-emerald-400 font-black tracking-widest uppercase text-xs">
                            <span class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center text-lg">🍵</span>
                            Prosedur Pengolahan Aman
                        </div>
                        <h2 class="text-4xl font-black mb-8 leading-tight tracking-tighter">Bagaimana cara <br>mengonsumsinya?</h2>
                        <div class="prose prose-invert prose-xl opacity-90 font-medium leading-loose">
                            {{ $plant->cara_olah }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                
                <div class="bg-emerald-600 rounded-[3rem] p-10 text-white shadow-xl shadow-emerald-900/20">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-2">Lokasi Budidaya</p>
                    <h3 class="text-3xl font-black mb-6">RW 0{{ $plant->rw }} <br>Desa Mekarjaya</h3>
                    <div class="h-1 w-20 bg-emerald-400 rounded-full mb-6"></div>
                    <p class="text-emerald-50/80 font-medium leading-relaxed">
                        Tanaman ini ditanam dan dirawat secara kolektif oleh warga di lingkungan RW 0{{ $plant->rw }}.
                    </p>
                </div>

                <div class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200 border border-slate-100">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 text-left">Stok Saat Ini</p>
                            <h4 class="text-5xl font-black text-slate-900">{{ $plant->stok }} <span class="text-lg font-bold text-slate-300 uppercase tracking-tighter">Unit</span></h4>
                        </div>
                        <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center text-2xl">🌱</div>
                    </div>
                    
                    @if($plant->stok > 0)
                    <div class="w-full py-4 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center gap-3 font-black text-xs uppercase tracking-widest border border-emerald-100">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                        Bibit Tersedia
                    </div>
                    @else
                    <div class="w-full py-4 bg-rose-50 text-rose-700 rounded-2xl flex items-center justify-center gap-3 font-black text-xs uppercase tracking-widest border border-rose-100">
                        Maaf, Stok Habis
                    </div>
                    @endif
                </div>

                <div class="bg-slate-50 rounded-[3rem] p-10 border-4 border-dashed border-slate-200 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-sm flex items-center justify-center text-4xl mb-6">🔳</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">QR Code Digital</p>
                    <p class="text-xs font-medium text-slate-400 mt-2 px-4 italic leading-relaxed">Gunakan kode ini untuk akses instan di lokasi kebun.</p>
                    <div class="bg-white rounded-[3rem] p-10 border-4 border-emerald-50 flex flex-col items-center justify-center text-center shadow-xl shadow-emerald-900/5">
    <div class="p-4 bg-white rounded-3xl shadow-inner mb-6 border border-slate-50">
        {!! QrCode::size(150)->eye('circle')->color(6, 78, 59)->generate(route('plant.detail', $plant->slug)) !!}
    </div>
    <p class="text-[10px] font-black text-emerald-800 uppercase tracking-[0.2em]">QR Digital ID</p>
    <p class="text-xs font-medium text-slate-400 mt-2 px-4 italic leading-relaxed">
        ID: {{ strtoupper(Str::random(5)) }}-{{ $plant->id }}
    </p>
</div>
                </div>

            </div>
        </div>
    </main>

    <footer class="py-12 text-center text-slate-1000 font-black text-[10px] uppercase tracking-[0.5em]">
        EcoHealth Smart System • 2026 Mekarjaya
    </footer>

</body>
</html>