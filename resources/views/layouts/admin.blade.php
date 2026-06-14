<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | EcoHealth Mekarjaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        (function() {
            const theme = localStorage.getItem('ecohealth-theme') || 'light';
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] } } }
        }
    </script>
    <style>
        * { -webkit-font-smoothing: antialiased; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
        html { transition: background-color 0.3s ease; }
        *, *::before, *::after { transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease; }
        img, svg { transition: none !important; }

        /* Sidebar slide for mobile */
        #sidebar { transition: transform 0.35s cubic-bezier(0.4,0,0.2,1); }
        #sidebar-overlay { transition: opacity 0.35s ease; }
        @media (max-width: 1024px) {
            #sidebar { transform: translateX(-100%); position: fixed; z-index: 50; }
            #sidebar.open { transform: translateX(0); }
        }
    </style>
    @yield('head')
</head>
<body class="bg-slate-100 dark:bg-slate-950 font-sans text-slate-900 dark:text-slate-100 flex min-h-screen">

    {{-- Sidebar Overlay (mobile) --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 opacity-0 pointer-events-none lg:hidden" onclick="closeSidebar()"></div>

    {{-- ===== SIDEBAR ===== --}}
    <aside id="sidebar" class="w-72 bg-emerald-950 dark:bg-slate-900 dark:border-r dark:border-slate-800 text-white flex flex-col h-screen lg:sticky lg:top-0 shadow-2xl overflow-y-auto flex-shrink-0">
        {{-- Logo --}}
        <div class="p-6 border-b border-white/5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl overflow-hidden shadow-lg group-hover:scale-110 transition duration-300 flex-shrink-0">
                    <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <span class="block text-lg font-extrabold tracking-tight text-white">EcoHealth</span>
                    <span class="block text-[10px] text-emerald-400 font-bold uppercase tracking-widest">Admin Panel</span>
                </div>
            </a>
        </div>

        {{-- Nav Links --}}
        <nav class="flex-grow p-4 space-y-1">
            <p class="text-[10px] font-black text-emerald-500/50 uppercase tracking-[0.2em] px-4 py-3">Menu Utama</p>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/40' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
                <span class="text-lg">📊</span> Dasbor Tanaman
            </a>

            <a href="{{ route('tips.manage') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('tips.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/40' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
                <span class="text-lg">💡</span> Tips Kesehatan
            </a>

            <a href="{{ route('lansia.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('lansia.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/40' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
                <span class="text-lg">👴</span> Data Lansia
            </a>

            <a href="{{ route('location.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('location.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/40' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
                <span class="text-lg">📍</span> Manajemen Peta
            </a>

            <div class="pt-4">
                <p class="text-[10px] font-black text-emerald-500/50 uppercase tracking-[0.2em] px-4 py-3">Lainnya</p>
                <a href="{{ route('index') }}" target="_blank" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-semibold text-sm text-slate-400 hover:bg-white/8 hover:text-white transition-all duration-200">
                    <span class="text-lg">🌐</span> Lihat Website
                </a>
            </div>
        </nav>

        {{-- Bottom: Theme + Logout --}}
        <div class="p-4 border-t border-white/5 space-y-2">
            {{-- Dark mode toggle --}}
            <button onclick="toggleTheme()" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-semibold text-slate-400 hover:bg-white/8 hover:text-white transition-all duration-200">
                <span class="text-lg dark:hidden">🌙</span>
                <span class="text-lg hidden dark:inline">☀️</span>
                <span class="dark:hidden">Mode Gelap</span>
                <span class="hidden dark:inline">Mode Terang</span>
            </button>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-semibold text-red-400 hover:bg-red-500/15 hover:text-red-300 transition-all duration-200">
                    <span class="text-lg">🚪</span> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN AREA ===== --}}
    <div class="flex-grow flex flex-col min-w-0">

        {{-- Top bar (mobile) --}}
        <header class="lg:hidden sticky top-0 z-30 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 px-4 h-16 flex items-center justify-between shadow-sm">
            <button onclick="openSidebar()" class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="font-extrabold text-slate-900 dark:text-white tracking-tight">EcoHealth Admin</span>
            <button onclick="toggleTheme()" class="w-10 h-10 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800 transition text-lg">
                <span class="dark:hidden">🌙</span><span class="hidden dark:inline">☀️</span>
            </button>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
        <div id="flash-msg" class="mx-4 lg:mx-8 mt-4 bg-emerald-500 text-white px-6 py-4 rounded-2xl flex items-center gap-3 font-semibold text-sm shadow-lg">
            <span>✅</span> {{ session('success') }}
            <button onclick="document.getElementById('flash-msg').remove()" class="ml-auto opacity-60 hover:opacity-100 text-lg leading-none">✕</button>
        </div>
        @endif
        @if(session('error'))
        <div id="flash-msg-err" class="mx-4 lg:mx-8 mt-4 bg-red-500 text-white px-6 py-4 rounded-2xl flex items-center gap-3 font-semibold text-sm shadow-lg">
            <span>❌</span> {{ session('error') }}
            <button onclick="document.getElementById('flash-msg-err').remove()" class="ml-auto opacity-60 hover:opacity-100 text-lg leading-none">✕</button>
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-grow p-4 sm:p-6 lg:p-10 xl:p-12">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('ecohealth-theme', isDark ? 'dark' : 'light');
        }
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            const ov = document.getElementById('sidebar-overlay');
            ov.classList.remove('opacity-0','pointer-events-none');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            const ov = document.getElementById('sidebar-overlay');
            ov.classList.add('opacity-0','pointer-events-none');
        }

        // Auto-hide flash
        setTimeout(() => {
            ['flash-msg','flash-msg-err'].forEach(id => {
                const el = document.getElementById(id);
                if (el) { el.style.opacity = '0'; el.style.transition = 'opacity 0.5s'; setTimeout(() => el?.remove(), 500); }
            });
        }, 4000);
    </script>

    @yield('scripts')
</body>
</html>
