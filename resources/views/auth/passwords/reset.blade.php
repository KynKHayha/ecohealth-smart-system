<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password | EcoHealth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#062C26] flex items-center justify-center min-h-screen p-6">

    <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-[120px] -z-10"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-900/20 rounded-full blur-[150px] -z-10"></div>

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-500/10 rounded-3xl border border-emerald-500/20 mb-4">
                <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
            </div>
            <h2 class="text-2xl font-800 text-white tracking-tight">Atur Password Baru</h2>
            <p class="text-emerald-100/50 text-sm mt-2">Silakan buat password baru yang kuat untuk akun admin Anda.</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-5">
                    <label class="text-[10px] font-800 text-emerald-400 uppercase tracking-[0.2em] block mb-2 ml-1">Email Admin</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ $email ?? old('email') }}" 
                            class="w-full bg-emerald-950/50 border border-emerald-800/50 rounded-2xl p-4 text-emerald-100/60 text-sm outline-none cursor-not-allowed" 
                            required readonly>
                        <div class="absolute right-4 top-4 text-emerald-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="text-[10px] font-800 text-emerald-400 uppercase tracking-[0.2em] block mb-2 ml-1">Password Baru</label>
                    <input type="password" name="password" 
                        class="w-full bg-emerald-900/20 border border-emerald-700/50 rounded-2xl p-4 text-white placeholder:text-emerald-100/20 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" 
                        placeholder="••••••••" required autofocus>
                    @error('password')
                        <span class="text-red-400 text-[10px] mt-2 ml-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="text-[10px] font-800 text-emerald-400 uppercase tracking-[0.2em] block mb-2 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" 
                        class="w-full bg-emerald-900/20 border border-emerald-700/50 rounded-2xl p-4 text-white placeholder:text-emerald-100/20 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" 
                        placeholder="••••••••" required>
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-[#062C26] font-800 py-4 rounded-2xl transition-all shadow-lg shadow-emerald-500/20 active:scale-[0.98]">
                    Simpan & Masuk Dashboard
                </button>
            </form>
        </div>

        <p class="text-center mt-8">
            <a href="{{ route('login') }}" class="text-xs font-bold text-emerald-100/30 hover:text-emerald-400 transition-colors">
                ← Batalkan Reset Password
            </a>
        </p>
    </div>

</body>
</html>