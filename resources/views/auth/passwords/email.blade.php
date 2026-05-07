<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | EcoHealth Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#062C26] flex items-center justify-center min-h-screen p-6 overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] -z-10"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-emerald-900/20 rounded-full blur-[150px] -z-10"></div>

    <div class="w-full max-w-md relative">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-emerald-500/10 rounded-[2rem] border border-emerald-500/20 mb-6 shadow-xl shadow-emerald-950/50">
                <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
            </div>
            <h2 class="text-3xl font-800 text-white tracking-tight">EcoHealth <span class="text-emerald-400">Admin</span></h2>
            <p class="text-emerald-100/40 text-sm mt-3 px-6 leading-relaxed">Masukkan email admin Anda untuk menerima instruksi pemulihan kata sandi.</p>
        </div>

        @if (session('status'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-2xl text-emerald-400 text-xs font-bold animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 p-8 rounded-[3rem] shadow-[0_32px_64px_-15px_rgba(0,0,0,0.5)]">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-8">
                    <label class="text-[10px] font-800 text-emerald-400 uppercase tracking-[0.25em] block mb-3 ml-2">Alamat Email Terdaftar</label>
                    <div class="relative group">
                        <input type="email" name="email" value="{{ old('email') }}" 
                            class="w-full bg-emerald-950/40 border border-emerald-800/40 rounded-2xl p-4 pl-12 text-white placeholder:text-emerald-100/20 focus:border-emerald-400 focus:ring-4 focus:ring-emerald-400/10 transition-all outline-none text-sm" 
                            placeholder="mekarj2026@gmail.com" required autofocus>
                        
                        <div class="absolute left-4 top-4 text-emerald-500/30 group-focus-within:text-emerald-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-red-400 text-[10px] mt-2 ml-2 block font-bold">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-[#062C26] font-800 py-4 rounded-2xl transition-all shadow-lg shadow-emerald-500/20 active:scale-[0.98] flex items-center justify-center gap-2">
                    Kirim Link Pemulihan
                </button>
            </form>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-100/30 hover:text-emerald-400 transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Halaman Login
            </a>
        </div>
    </div>

</body>
</html>