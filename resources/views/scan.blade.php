<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR | EcoHealth Mekarjaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        (function() {
            const t = localStorage.getItem('ecohealth-theme') || 'light';
            if (t === 'dark') document.documentElement.classList.add('dark');
        })();
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Plus Jakarta Sans','sans-serif'] } } } }
    </script>
    <style>
        * { -webkit-font-smoothing: antialiased; }
        #reader { border: none !important; }
        #reader video { border-radius: 1.5rem !important; object-fit: cover; width: 100% !important; }
        #reader__scan_region { border-radius: 1.5rem; overflow: hidden; }
        #reader__camera_selection { display: none; }

        @keyframes scanline { 0%,100%{top:5%} 50%{top:90%} }
        .scanline { animation: scanline 2.5s ease-in-out infinite; }
    </style>
</head>
<body class="font-sans bg-slate-950 dark:bg-slate-950 min-h-screen flex flex-col items-center justify-center p-4 relative overflow-hidden">

    {{-- Background orbs --}}
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/8 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-teal-400/6 rounded-full blur-[80px] pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-sm">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('index') }}" class="flex items-center gap-2 text-emerald-400 hover:text-emerald-300 font-bold text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                Batal
            </a>
            <div class="text-center">
                <h1 class="text-xl font-black text-white tracking-tight">Scan QR Tanaman</h1>
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">EcoHealth Scanner</p>
            </div>
            <div class="w-10"></div>
        </div>

        {{-- Scanner frame --}}
        <div class="relative mb-6">
            {{-- Corner decorations --}}
            <div class="absolute -top-2 -left-2 w-8 h-8 border-t-4 border-l-4 border-emerald-500 rounded-tl-2xl z-10"></div>
            <div class="absolute -top-2 -right-2 w-8 h-8 border-t-4 border-r-4 border-emerald-500 rounded-tr-2xl z-10"></div>
            <div class="absolute -bottom-2 -left-2 w-8 h-8 border-b-4 border-l-4 border-emerald-500 rounded-bl-2xl z-10"></div>
            <div class="absolute -bottom-2 -right-2 w-8 h-8 border-b-4 border-r-4 border-emerald-500 rounded-br-2xl z-10"></div>

            {{-- Scan line --}}
            <div class="absolute left-0 right-0 h-0.5 bg-emerald-400 shadow-[0_0_12px_rgba(16,185,129,0.8)] scanline z-20"></div>

            {{-- Reader --}}
            <div id="reader" class="rounded-3xl overflow-hidden bg-slate-800 aspect-square"></div>
        </div>

        {{-- Status --}}
        <div id="scan-status" class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
            <div class="flex items-center justify-center gap-2.5 mb-2">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                </span>
                <span class="text-emerald-400 font-black text-sm">Kamera Aktif</span>
            </div>
            <p class="text-slate-500 text-xs font-medium">Arahkan kamera ke QR code pada papan tanaman</p>
        </div>

        {{-- Result --}}
        <div id="scan-result" class="hidden mt-4 bg-emerald-500/20 border border-emerald-500/40 rounded-2xl p-5 text-center">
            <p class="text-emerald-300 font-black text-sm mb-2">✅ QR Terdeteksi!</p>
            <p id="result-text" class="text-white/70 text-xs font-medium break-all">-</p>
            <p class="text-emerald-400/60 text-[11px] mt-2">Mengarahkan...</p>
        </div>

        {{-- Tip --}}
        <p class="text-center text-slate-600 text-xs font-medium mt-6">
            💡 Pastikan pencahayaan cukup untuk hasil scan yang optimal
        </p>
    </div>

    <script>
        const scanner = new Html5QrcodeScanner('reader', {
            fps: 10,
            qrbox: { width: 280, height: 280 },
            aspectRatio: 1.0,
        }, false);

        scanner.render(
            function(text) {
                // QR berhasil di-scan
                const resultDiv = document.getElementById('scan-result');
                const resultText = document.getElementById('result-text');
                resultDiv.classList.remove('hidden');
                resultText.textContent = text;

                // Update status
                document.getElementById('scan-status').classList.add('hidden');

                // Redirect setelah 1.5 detik
                setTimeout(() => { window.location.href = text; }, 1500);
            },
            function(error) {
                // Silent fail — tidak perlu tampilkan error scan biasa
            }
        );
    </script>
</body>
</html>