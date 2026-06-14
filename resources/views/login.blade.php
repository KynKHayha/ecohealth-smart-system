<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Eco Health Smart System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        (function() {
            const t = localStorage.getItem('ecohealth-theme') || 'light';
            if (t === 'dark') document.documentElement.classList.add('dark');
        })();
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Plus Jakarta Sans','sans-serif'] } } } }
    </script>
    <style>
        * { -webkit-font-smoothing: antialiased; }
        @keyframes float { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-15px) rotate(3deg)} }
        @keyframes float2 { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-10px) rotate(-2deg)} }
        .orb1 { animation: float 6s ease-in-out infinite; }
        .orb2 { animation: float2 8s ease-in-out infinite; }
        .orb3 { animation: float 10s ease-in-out infinite reverse; }
    </style>
</head>
<body class="font-sans bg-emerald-950 dark:bg-slate-950 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Background elements --}}
    <div class="absolute inset-0 opacity-[0.04] bg-[url('https://www.transparenttextures.com/patterns/leaf.png')]"></div>
    <div class="orb1 absolute top-1/4 left-1/6 w-[400px] h-[400px] bg-emerald-500/15 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="orb2 absolute bottom-1/4 right-1/6 w-[350px] h-[350px] bg-teal-400/10 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="orb3 absolute top-3/4 left-1/2 w-[300px] h-[300px] bg-emerald-600/10 rounded-full blur-[90px] pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.02]" style="background-image:linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:50px 50px"></div>

    <div class="relative z-10 w-full max-w-md">
        {{-- Logo + Title --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl overflow-hidden shadow-2xl mb-4 ring-2 ring-white/20">
                <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <h1 class="text-3xl font-black text-white tracking-tight">EcoHealth Admin</h1>
            <p class="text-emerald-300/60 text-sm mt-2">Masuk untuk mengelola sistem Desa Mekarjaya</p>
        </div>

        {{-- Card --}}
        <div class="bg-white/10 dark:bg-white/5 backdrop-blur-2xl border border-white/20 dark:border-white/10 p-8 sm:p-10 rounded-3xl shadow-2xl">

            @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/40 text-red-200 p-4 rounded-2xl mb-6 text-sm flex items-center gap-2">
                <span>⚠️</span> {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-[11px] font-black text-emerald-100/70 uppercase tracking-widest mb-2">Email Admin</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="admin@mekarjaya.id"
                        class="w-full bg-white/8 dark:bg-white/5 border border-white/15 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 rounded-2xl px-5 py-4 text-white placeholder:text-white/25 outline-none transition-all text-sm font-medium">
                </div>

                <div>
                    <label class="block text-[11px] font-black text-emerald-100/70 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            placeholder="••••••••"
                            class="w-full bg-white/8 dark:bg-white/5 border border-white/15 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 rounded-2xl px-5 py-4 text-white placeholder:text-white/25 outline-none transition-all text-sm font-medium pr-12">
                        <button type="button" onclick="togglePwd()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80 transition text-lg">
                            <span id="pwd-eye">👁️</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/10 accent-emerald-500">
                        <span class="text-xs text-emerald-100/50 group-hover:text-emerald-100/80 transition font-medium">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-emerald-400 hover:text-emerald-300 transition">Lupa password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-white dark:bg-emerald-500 text-emerald-950 dark:text-white py-4 rounded-2xl font-black text-base shadow-2xl hover:bg-emerald-50 dark:hover:bg-emerald-400 hover:scale-[1.02] active:scale-[0.98] transition-all mt-2">
                    Masuk ke Dashboard 🚀
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <div class="mt-8 text-center">
            <a href="{{ route('index') }}" class="text-emerald-100/30 hover:text-emerald-100/70 text-sm font-medium transition inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Halaman Utama
            </a>
        </div>

        {{-- Dark mode toggle --}}
        <div class="mt-4 text-center">
            <button onclick="toggleTheme()" class="text-emerald-100/20 hover:text-emerald-100/40 text-xs font-medium transition inline-flex items-center gap-1.5">
                <span class="dark:hidden">🌙 Mode Gelap</span><span class="hidden dark:inline">☀️ Mode Terang</span>
            </button>
        </div>
    </div>

    <script>
        function togglePwd() {
            const el = document.getElementById('password');
            el.type = el.type === 'password' ? 'text' : 'password';
        }
        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('ecohealth-theme', isDark ? 'dark' : 'light');
        }
    </script>
</body>
</html>