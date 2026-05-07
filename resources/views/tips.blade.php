<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tips Kesehatan Alami | EcoHealth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            /* Background mewah: Gradasi lembut dari Sage ke Cream */
            background: linear-gradient(135deg, #f0f4f2 0%, #fdfbf7 100%);
            min-height: 100vh;
        }
        .card-glow:hover {
            box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.15);
        }
    </style>
</head>
<body class="antialiased">

    <nav class="p-8 max-w-7xl mx-auto flex justify-between items-center">
        <a href="{{ route('index') }}" class="flex items-center gap-2 group">
            <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
            <span class="font-800 text-xl tracking-tighter text-slate-900">EcoHealth</span>
        </a>
        <a href="{{ route('index') }}" class="px-6 py-2 bg-white/80 backdrop-blur-md border border-slate-200 rounded-full text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm"> Kembali</a>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-12">
        <header class="text-center mb-24">
            <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6">Informasi Edukasi</div>
            <h1 class="text-6xl md:text-7xl font-black text-slate-900 tracking-tighter leading-none">Tips Kesehatan <br><span class="text-emerald-600">Alami & Tradisional</span></h1>
        </header>

        <div class="space-y-24">
            @foreach($tips as $index => $tip)
<div class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-12 mb-24">
    <div class="w-64 h-64 bg-white rounded-[3rem] shadow-2xl flex items-center justify-center text-8xl">
        {{ $tip->icon }}
    </div>
    <div class="flex-1">
        <span class="bg-emerald-100 text-emerald-600 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">{{ $tip->tag }}</span>
        <h3 class="text-4xl font-800 text-slate-900 mt-4 mb-6 leading-tight">{{ $tip->judul }}</h3>
        <p class="text-slate-500 text-lg leading-relaxed">{{ $tip->deskripsi }}</p>
    </div>
</div>
@endforeach

        </div>

        <div class="mt-40 bg-slate-900 rounded-[4rem] p-12 md:p-20 text-center text-white relative overflow-hidden shadow-3xl shadow-emerald-900/20">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 30px 30px;"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tighter">Punya Pengetahuan Herbal?</h2>
                <p class="text-emerald-100/60 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">
                    Mari gotong royong lestarikan budaya leluhur. Bagikan tips kesehatanmu kepada kader RW untuk ditampilkan di sini.
                </p>
<a href="https://wa.me/6281281954124?text=Hallo%20Admin%20mekarjaya%2C%20saya%20mau%20saran%20tips%20kesehatan%20nih" 
   class="inline-block px-12 py-5 bg-emerald-500 text-white rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-white hover:text-slate-900 transition-all duration-300 shadow-xl shadow-emerald-500/20">
    Hubungi Admin Mekarjaya
</a>
            </div>
        </div>
    </main>

    <footer class="py-20 text-center">
        <p class="text-[10px] font-black text-slate-1000 uppercase tracking-[0.5em]">EcoHealth System • Mekarjaya 2026</p>
    </footer>
</body>
</html>