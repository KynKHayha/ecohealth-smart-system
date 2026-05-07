<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Eco Health Smart System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-emerald-950 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')]"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/20 rounded-full blur-[120px]"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-400/10 rounded-full blur-[120px]"></div>

    <div class="relative z-10 w-full max-w-[450px]">
        <div class="flex flex-col items-center mb-8">
            <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
            <h1 class="text-3xl font-800 text-white tracking-tighter">EcoHealth Admin</h1>
            <p class="text-emerald-300/60 text-sm mt-2 text-center leading-relaxed">
                Silakan masuk untuk mengelola database <br> tanaman dan stok Desa Mekarjaya.
            </p>
        </div>

        <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-10 rounded-[2.5rem] shadow-2xl">
            
            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-4 rounded-2xl mb-6 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf {{-- TOKEN KEAMANAN LARAVEL --}}
                
                <div>
                    <label class="block text-xs font-bold text-emerald-100 uppercase tracking-widest mb-2 ml-1">Email Admin</label>
                    <input type="email" name="email" required placeholder="admin@mekarjaya.id" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder:text-emerald-100/30 focus:outline-none focus:border-emerald-400 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-emerald-100 uppercase tracking-widest mb-2 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder:text-emerald-100/30 focus:outline-none focus:border-emerald-400 transition-all">
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 checked:bg-emerald-500">
                        <span class="text-xs text-emerald-100/60 group-hover:text-emerald-100 transition">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-emerald-400 hover:text-emerald-300">
    Lupa password?
</a>
                </div>

                <button type="submit" 
                    class="w-full bg-white text-emerald-950 py-5 rounded-2xl font-800 text-lg shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all mt-4">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        <div class="mt-10 text-center">
            <a href="/" class="text-emerald-100/40 text-sm font-bold hover:text-emerald-100 transition flex items-center justify-center gap-2">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</body>
</html>