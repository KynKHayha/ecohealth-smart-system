<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR - EcoHealth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        #reader { border: none !important; }
        #reader video { border-radius: 2rem; object-fit: cover; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('index') }}" class="text-emerald-400 font-bold mb-4 inline-block">← Batal</a>
            <h1 class="text-3xl font-black text-white tracking-tighter">Scan QR Tanaman</h1>
            <p class="text-slate-400">Arahkan kamera ke kode QR di papan tanaman</p>
        </div>

        <div class="relative group">
            <div class="absolute -top-2 -left-2 w-10 h-10 border-t-4 border-l-4 border-emerald-500 z-10 rounded-tl-xl"></div>
            <div class="absolute -top-2 -right-2 w-10 h-10 border-t-4 border-r-4 border-emerald-500 z-10 rounded-tr-xl"></div>
            <div class="absolute -bottom-2 -left-2 w-10 h-10 border-b-4 border-l-4 border-emerald-500 z-10 rounded-bl-xl"></div>
            <div class="absolute -bottom-2 -right-2 w-10 h-10 border-b-4 border-r-4 border-emerald-500 z-10 rounded-br-xl"></div>
            
            <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500 shadow-[0_0_15px_rgba(16,185,129,0.8)] z-20 animate-bounce opacity-50"></div>

            <div id="reader" class="overflow-hidden bg-slate-800 rounded-[2.5rem] shadow-2xl"></div>
        </div>

        <div class="mt-8 bg-slate-800/50 p-6 rounded-3xl border border-slate-700 text-center">
            <div class="flex items-center justify-center gap-3 text-emerald-400 font-bold mb-2">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                Sistem Kamera Aktif
            </div>
            <p class="text-xs text-slate-500 uppercase tracking-widest font-black">Pastikan pencahayaan cukup</p>
        </div>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Ketika QR terbaca, langsung arahkan ke URL yang ada di dalam QR tersebut
            window.location.href = decodedText;
        }

        function onScanFailure(error) {
            // Kita biarkan kosong agar tidak mengganggu proses scan
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", 
            { 
                fps: 10, 
                qrbox: {width: 250, height: 250},
                aspectRatio: 1.0 
            }, 
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>