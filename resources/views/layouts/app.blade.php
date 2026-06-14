<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eco Health Smart System | Desa Mekarjaya')</title>
    <meta name="description" content="@yield('meta_desc', 'Satu platform digital untuk manajemen bibit TOGA, edukasi kesehatan, dan pemantauan warga lansia Desa Mekarjaya.')">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script>
        // Dark mode: set sebelum render agar tidak flicker
        (function() {
            const theme = localStorage.getItem('ecohealth-theme') || 'light';
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();

        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        emerald: { 950: '#022c22' },
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease forwards',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: { '0%': { opacity: '0', transform: 'translateY(20px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        float: { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-10px)' } },
                    }
                }
            }
        }
    </script>

    <style>
        * { -webkit-font-smoothing: antialiased; }

        /* Scrollbar custom */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }

        /* Glassmorphism utility */
        .glass { background: rgba(255,255,255,0.7); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.4); }
        .dark .glass { background: rgba(15,23,42,0.7); border: 1px solid rgba(255,255,255,0.08); }

        /* Nav glass */
        .nav-glass { background: rgba(255,255,255,0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .dark .nav-glass { background: rgba(2,26,18,0.9); border-bottom: 1px solid rgba(255,255,255,0.06); }

        /* Smooth theme transition */
        html { transition: background-color 0.3s ease, color 0.3s ease; }
        *, *::before, *::after { transition: background-color 0.3s ease, border-color 0.3s ease; }
        img, svg, video { transition: none !important; }

        /* Mobile menu */
        #mobile-menu { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1); }
        #mobile-menu.open { max-height: 400px; }
    </style>

    @yield('head')
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans min-h-screen transition-colors duration-300">

    {{-- ===== NAVBAR ===== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 nav-glass transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16 md:h-20">

                {{-- Logo --}}
                <a href="{{ route('index') }}" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="w-10 h-10 rounded-2xl overflow-hidden shadow-md group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo EcoHealth" class="w-full h-full object-cover">
                    </div>
                    <span class="font-extrabold text-lg tracking-tight text-slate-900 dark:text-white">EcoHealth <span class="text-emerald-600">Mekarjaya</span></span>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('index') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-all">Beranda</a>
                    <a href="{{ route('plant.koleksi') }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('plant.koleksi') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-all">Koleksi Herbal</a>
                    <a href="{{ route('plant.tips') }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('plant.tips') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-all">Tips Sehat</a>
                    <a href="{{ route('plant.tracking') }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('plant.tracking') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-all">Peta Lokasi</a>
                    <a href="{{ route('kontak') }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('kontak') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-all">Kontak</a>
                </div>

                {{-- Right side: Dark mode + Login + Hamburger --}}
                <div class="flex items-center gap-2">
                    {{-- Dark Mode Toggle --}}
                    <button id="theme-toggle" onclick="toggleTheme()" class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all" aria-label="Toggle Dark Mode">
                        <span id="theme-icon-dark" class="hidden dark:block text-lg">☀️</span>
                        <span id="theme-icon-light" class="block dark:hidden text-lg">🌙</span>
                    </button>

                    {{-- Login Button (desktop) --}}
                    <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold transition-all shadow-md shadow-emerald-500/20 hover:scale-105">
                        <span>🔑</span> Admin
                    </a>

                    {{-- Hamburger (mobile) --}}
                    <button id="menu-btn" onclick="toggleMenu()" class="md:hidden w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                        <svg id="menu-icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('index') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-all">🏠 Beranda</a>
                <a href="{{ route('plant.koleksi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('plant.koleksi') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-all">🌿 Koleksi Herbal</a>
                <a href="{{ route('plant.tips') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('plant.tips') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-all">💡 Tips Sehat</a>
                <a href="{{ route('plant.tracking') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('plant.tracking') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-all">📍 Peta Lokasi</a>
                <a href="{{ route('kontak') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('kontak') ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-all">📞 Kontak</a>
                <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition-all">🔑 Login Admin</a>
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main>
        @if(session('success'))
            <div id="flash-success" class="fixed top-20 right-4 z-[999] bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 font-bold text-sm animate-fade-in-up">
                <span>✅</span> {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="ml-2 opacity-60 hover:opacity-100">✕</button>
            </div>
        @endif
        @if(session('error'))
            <div id="flash-error" class="fixed top-20 right-4 z-[999] bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 font-bold text-sm animate-fade-in-up">
                <span>❌</span> {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="ml-2 opacity-60 hover:opacity-100">✕</button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-emerald-950 dark:bg-slate-900 dark:border-t dark:border-slate-800 text-emerald-100 pt-16 pb-8 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                {{-- Brand --}}
                <div class="space-y-5 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden"><img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo" class="w-full h-full object-cover"></div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">EcoHealth</span>
                    </div>
                    <p class="text-sm leading-relaxed text-emerald-100/50 font-medium max-w-xs">Digitalisasi Desa Mekarjaya untuk manajemen kesehatan alami dan pelestarian tanaman obat.</p>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="text-white font-bold text-sm mb-5 uppercase tracking-widest">Navigasi</h4>
                    <ul class="space-y-3 text-sm font-medium text-emerald-100/50">
                        <li><a href="{{ route('index') }}" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="{{ route('plant.koleksi') }}" class="hover:text-emerald-400 transition">Koleksi Tanaman</a></li>
                        <li><a href="{{ route('plant.tips') }}" class="hover:text-emerald-400 transition">Tips Kesehatan</a></li>
                        <li><a href="{{ route('plant.tracking') }}" class="hover:text-emerald-400 transition">Peta Lokasi</a></li>
                    </ul>
                </div>

                {{-- Admin --}}
                <div>
                    <h4 class="text-white font-bold text-sm mb-5 uppercase tracking-widest">Administrasi</h4>
                    <ul class="space-y-3 text-sm font-medium text-emerald-100/50">
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition">Login Admin</a></li>
                        <li><a href="{{ route('plant.scan') }}" class="hover:text-emerald-400 transition">Scan QR Tanaman</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h4 class="text-white font-bold text-sm mb-5 uppercase tracking-widest">Kontak</h4>
                    <ul class="space-y-3 text-sm font-medium text-emerald-100/50">
                        <li class="flex items-center gap-2"><span>📍</span> Desa Mekarjaya, Jawa Barat</li>
                        <li class="flex items-center gap-2"><span>📧</span> mekarj2026@gmail.com</li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><span>✉️</span> Kirim Pesan</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs text-emerald-100/20 font-bold uppercase tracking-[0.4em]">© 2026 Eco Health Smart System • Mekarjaya</p>
                <button onclick="toggleTheme()" class="text-xs text-emerald-100/30 hover:text-emerald-400 transition font-medium flex items-center gap-2">
                    <span class="dark:hidden">🌙 Mode Gelap</span>
                    <span class="hidden dark:inline">☀️ Mode Terang</span>
                </button>
            </div>
        </div>
    </footer>

    {{-- ===== SCRIPTS ===== --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // AOS Init
        AOS.init({ duration: 800, once: true, offset: 60, easing: 'ease-out-cubic' });

        // Dark mode toggle
        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('ecohealth-theme', isDark ? 'dark' : 'light');
        }

        // Mobile menu
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');
            menu.classList.toggle('open');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        }

        // Navbar scroll behavior
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-lg', 'shadow-emerald-900/5');
            } else {
                nav.classList.remove('shadow-lg', 'shadow-emerald-900/5');
            }
        });

        // Auto-hide flash messages
        setTimeout(() => {
            ['flash-success','flash-error'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.opacity = '0', el.style.transition = 'opacity 0.5s', setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>

    @yield('scripts')
</body>
</html>
