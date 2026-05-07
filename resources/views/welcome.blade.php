<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Health Smart System | Desa Mekarjaya</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: { emerald: { 950: '#022c22' } }
                }
            }
        }
    </script>
</head>
<body x-data="{ openDetail: false, selectedPlant: {} }" class="bg-[#FDFDFD] text-slate-900 antialiased overflow-x-hidden">

    <header class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-emerald-950">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')]"></div>
        <div class="absolute -top-24 -left-24 w-[500px] h-[500px] bg-emerald-500/20 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-24 -right-24 w-[500px] h-[500px] bg-emerald-400/10 rounded-full blur-[120px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-6 py-2.5 rounded-full border border-white/20 mb-8">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold text-emerald-100 uppercase tracking-widest">Digitalisasi Desa Mekarjaya</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-extrabold text-white mb-8 leading-[1.1] tracking-tight">
                Eco Health <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Smart System</span>
            </h1>
            
            <p class="text-slate-300 text-xl md:text-2xl mb-12 max-w-4xl mx-auto font-medium leading-relaxed opacity-90">
                Satu platform untuk manajemen bibit, edukasi TOGA, dan pemantauan kesehatan berbasis digital secara real-time.
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="/login" class="group flex items-center gap-4 bg-emerald-800/40 backdrop-blur-md text-white px-10 py-5 rounded-[2rem] font-800 text-lg border border-white/20 hover:bg-emerald-700/60 transition-all duration-300">
                    <span class="text-2xl">🔑</span> Login Admin
                </a>
                <a href="#katalog" class="group flex items-center gap-4 bg-emerald-800/40 backdrop-blur-md text-white px-10 py-5 rounded-[2rem] font-800 text-lg border border-white/20 hover:bg-emerald-700/60 transition-all duration-300">
                    <span class="text-2xl">📖</span> Info Tanaman
                </a>
                <a href="#kontak" class="group flex items-center gap-4 bg-emerald-800/40 backdrop-blur-md text-white px-10 py-5 rounded-[2rem] font-800 text-lg border border-white/20 hover:bg-emerald-700/60 transition-all duration-300">
                    <span class="text-2xl">📞</span> Hubungi Kami
                </a>
            </div>
        </div>
    </header>

<section class="max-w-[1400px] mx-auto px-10 py-32 bg-white rounded-[4rem] -mt-20 relative z-30 shadow-2xl shadow-emerald-900/5" data-aos="fade-up">
    <div class="mb-20 text-center md:text-left">
        <div class="inline-block px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-sm font-bold mb-4 uppercase tracking-widest">
            Fitur Utama Kami
        </div>
        <h2 class="text-5xl md:text-7xl font-black text-slate-900 mb-6 tracking-tighter">
            Teknologi <span class="">Herbal</span> Masa Kini
        </h2>
        <p class="text-xl text-slate-500 font-medium max-w-2xl">Solusi lengkap untuk pengelolaan tanaman obat dan edukasi kesehatan alami berbasis digital di Desa Mekarjaya.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <div class="group p-10 rounded-[3.5rem] border border-slate-100 bg-white hover:bg-emerald-600 transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.3)]">
            <div class="w-20 h-20 bg-emerald-50 text-4xl flex items-center justify-center rounded-[2rem] mb-10 group-hover:bg-white/20 group-hover:scale-110 transition duration-500 shadow-sm">📸</div>
            <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-white transition">QR Code Terintegrasi</h3>
            <p class="text-slate-500 leading-relaxed mb-10 group-hover:text-emerald-50 transition">Scan kode unik pada setiap tanaman untuk akses informasi manfaat secara instan di genggaman Anda.</p>
            <a href="{{ route('plant.scan') }}" class="block w-full py-4 border-2 border-emerald-600 text-emerald-600 text-center rounded-2xl font-black group-hover:bg-white group-hover:border-white transition-all duration-300">Detail Fitur</a>
        </div>

<div class="group p-10 rounded-[3.5rem] border border-slate-100 bg-white hover:bg-emerald-600 transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.3)]">
    <div class="w-20 h-20 bg-emerald-50 text-4xl flex items-center justify-center rounded-[2rem] mb-10 group-hover:bg-white/20 group-hover:scale-110 transition duration-500 shadow-sm">📖</div>
    
    <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-white transition">Data Lengkap</h3>
    
    <p class="text-slate-500 leading-relaxed mb-10 group-hover:text-emerald-50 transition">Informasi komprehensif mulai dari nama latin, dosis tepat, hingga cara pengolahan yang aman sesuai prosedur.</p>
    
    <a href="{{ route('plant.koleksi') }}" class="block w-full py-4 border-2 border-emerald-600 text-emerald-600 text-center rounded-2xl font-black group-hover:bg-white group-hover:border-white transition-all duration-300">
        Buka Koleksi
    </a>
</div>

<div class="relative group p-10 rounded-[3.5rem] border border-slate-100 bg-white hover:bg-emerald-600 transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.3)] cursor-pointer">
    <a href="{{ route('plant.tips') }}" class="absolute inset-0 z-10"></a>
    <div class="relative z-0">
        <div class="w-20 h-20 bg-emerald-50 text-4xl flex items-center justify-center rounded-[2rem] mb-10 group-hover:bg-white/20 transition duration-500">
            💡
        </div>
        <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-white transition">Tips Alami</h3>
        <p class="text-slate-500 leading-relaxed mb-10 group-hover:text-emerald-50 transition">
            Pelajari cara mengolah, menyimpan, dan waktu terbaik mengonsumsi ramuan herbal agar khasiatnya maksimal.
        </p>
        <div class="w-full py-4 border-2 border-emerald-600 text-emerald-600 text-center rounded-2xl font-black group-hover:bg-white transition-all duration-300">
            Baca Tips
        </div>
    </div>
</div>

        <div class="group p-10 rounded-[3.5rem] border border-slate-100 bg-white hover:bg-emerald-600 transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.3)]">
            <div class="w-20 h-20 bg-emerald-50 text-4xl flex items-center justify-center rounded-[2rem] mb-10 group-hover:bg-white/20 group-hover:scale-110 transition duration-500 shadow-sm">📍</div>
            <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-white transition">Greenhouse Track</h3>
            <p class="text-slate-500 leading-relaxed mb-10 group-hover:text-emerald-50 transition">Lacak posisi bibit tanaman di area greenhouse dengan sistem navigasi blok untuk memudahkan pencarian.</p>
            <button class="w-full py-4 border-2 border-emerald-600 text-emerald-600 rounded-2xl font-black group-hover:bg-white group-hover:border-white transition-all duration-300">Detail Fitur</button>
        </div>

    </div>
</section>

<section id="katalog" class="max-w-[1400px] mx-auto px-10 py-40">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-24 gap-12" data-aos="fade-right">
        <div>
            <h2 class="text-6xl md:text-8xl font-black text-slate-900 tracking-tighter mb-6 leading-none">Tanaman Obat <br> Populer</h2>
            <p class="text-2xl text-slate-500 font-medium">Jelajahi koleksi tanaman obat yang tersedia di greenhouse kami.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($plants->take(3) as $p)
        <div class="group bg-white rounded-[3rem] p-4 border border-slate-100 hover:shadow-2xl transition-all duration-500">
            <div class="relative overflow-hidden rounded-[2.5rem] h-64 mb-6">
                <img src="{{ asset('images/plants/' . $p->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            </div>
            <div class="px-4 pb-4">
                <h3 class="text-2xl font-black text-slate-900 mb-2">{{ $p->nama_tanaman }}</h3>
                <p class="text-emerald-600 font-bold italic mb-4">{{ $p->nama_latin }}</p>
                <a href="{{ route('plant.detail', $p->slug) }}" class="inline-block text-slate-900 font-black hover:text-emerald-600 transition">Lihat Detail →</a>
            </div>
        </div>
    @endforeach
</div>
</section>

    <div 
        x-show="openDetail" 
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-emerald-950/80 backdrop-blur-md"
        @click.self="openDetail = false"
    >
        <div class="bg-white max-w-4xl w-full rounded-[4rem] overflow-hidden shadow-2xl relative">
            <button @click="openDetail = false" class="absolute top-8 right-8 w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center font-bold hover:bg-slate-200 transition-all z-20 text-xl shadow-sm">✕</button>
            
            <div class="flex flex-col md:flex-row">
                <div class="md:w-[45%] h-80 md:h-auto bg-slate-200">
                    <img :src="selectedPlant.image ? '/images/plants/' + selectedPlant.image : 'https://images.unsplash.com/photo-1530103043960-ef38714abb15?auto=format&fit=crop&q=80&w=600'" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-14 md:w-[55%]">
                    <span x-text="selectedPlant.kategori" class="text-emerald-600 font-black text-xs uppercase tracking-[0.3em]"></span>
                    <h2 x-text="selectedPlant.nama_tanaman" class="text-5xl font-bold text-slate-900 mt-2 mb-2 tracking-tighter"></h2>
                    <p x-text="selectedPlant.nama_latin" class="text-emerald-600 italic text-xl mb-8 opacity-60"></p>
                    
                    <div class="space-y-6">
                        <div class="bg-emerald-50 p-6 rounded-[2rem] border border-emerald-100">
                            <h5 class="text-xs font-black text-emerald-700 uppercase mb-2 tracking-widest">Manfaat Utama</h5>
                            <p x-text="selectedPlant.manfaat" class="text-md text-emerald-900 leading-relaxed font-medium"></p>
                        </div>
                        <a :href="'/tanaman/' + selectedPlant.slug" class="block w-full text-center py-6 bg-emerald-600 text-white rounded-[2rem] font-800 text-lg shadow-2xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all transform hover:translate-y-[-2px]">Pelajari Detail →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="relative py-32 px-6 overflow-hidden bg-emerald-900">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')]"></div>
        <div class="relative z-10 max-w-5xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-4xl md:text-6xl font-extrabold text-white mb-8 leading-tight tracking-tight">
                Mulai Perjalanan Kesehatan <br class="hidden md:block"> Alami Anda Sekarang
            </h2>
            <p class="text-emerald-100 text-xl mb-12 opacity-80 max-w-3xl mx-auto leading-relaxed font-medium">
                Temukan informasi lengkap tentang tanaman obat dan tips kesehatan alami untuk kehidupan Desa Mekarjaya yang lebih sehat.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="#katalog" class="border-2 border-white text-white px-12 py-5 rounded-[2rem] font-800 text-lg hover:bg-white/10 transition-all">Jelajahi Tanaman</a>
                <a href="#" class="border-2 border-white text-white px-12 py-5 rounded-[2rem] font-800 text-lg hover:bg-white/10 transition-all">Baca Tips Kesehatan</a>
            </div>
        </div>
    </section>

    <footer class="bg-[#022c22] text-emerald-100 pt-24 pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('index') }}" class="flex items-center gap-3 group">
    <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
    
    <span class="text-3xl font-black text-white tracking-tighter">EcoHealth</span>
</a>
                    </div>
                    <p class="text-md leading-relaxed opacity-60 font-medium">
                        Pusat informasi dan manajemen tanaman obat berbasis teknologi barcode untuk kesehatan alami Desa Mekarjaya yang lebih baik.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-800 text-xl mb-8">Navigasi Cepat</h4>
                    <ul class="space-y-5 text-md font-medium opacity-60">
                        <li><a href="#katalog" class="hover:text-emerald-400 transition-colors">Daftar Tanaman</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Tips Kesehatan</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Login Admin</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-800 text-xl mb-8">Layanan Digital</h4>
                    <ul class="space-y-5 text-md font-medium opacity-60">
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">QR Scanner</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Database Tanaman</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Info Greenhouse</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-800 text-xl mb-8">Kontak</h4>
                    <ul class="space-y-5 text-md font-medium opacity-60 italic">
                        <li>📍 Desa Mekarjaya, Jawa Barat</li>
                        <li>📞 +62 812-3456-7890</li>
                        <li>✉️ info@mekarjaya.id</li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-10 border-t border-white/5 opacity-20 text-xs tracking-[0.5em] font-black uppercase">
                © 2026 Eco Health Smart System • Mekarjaya
            </div>
        </div>
    </footer>

    <script>
        AOS.init({ duration: 1200, once: true, offset: 100 });
    </script>
</body>
</html>