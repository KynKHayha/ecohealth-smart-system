<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $plant->nama_tanaman }} | Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-emerald-900 font-['Plus_Jakarta_Sans'] antialiased">

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="bg-white max-w-4xl w-full rounded-[3rem] shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
            
            <div class="p-12 bg-slate-50 flex flex-col items-center justify-center border-r border-slate-100">
                <div class="w-full h-64 rounded-[2rem] overflow-hidden mb-8 shadow-inner bg-slate-200">
                    <img src="https://images.unsplash.com/photo-1512103522279-9e54d432b77c?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover">
                </div>
                <div class="bg-white p-6 rounded-[2rem] shadow-xl border-4 border-emerald-600">
                     {!! QrCode::size(150)->generate(request()->url()) !!}
                </div>
                <p class="mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">ID Tanaman: {{ $plant->slug }}</p>
            </div>

            <div class="p-12 overflow-y-auto max-h-[85vh]">
                <a href="/" class="text-sm font-bold text-emerald-600 mb-8 inline-block">← Kembali ke Katalog</a>
                
                <span class="block bg-emerald-100 text-emerald-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase w-fit mb-4">{{ $plant->kategori }}</span>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">{{ $plant->nama_tanaman }}</h1>
                <p class="text-emerald-600 italic text-lg mb-8">{{ $plant->nama_latin }}</p>

                <div class="space-y-8">
                    <div>
                        <h2 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-3">Manfaat & Khasiat</h2>
                        <p class="text-slate-600 leading-relaxed text-sm">{{ $plant->manfaat }}</p>
                    </div>

                    <div class="bg-orange-50 p-8 rounded-[2rem] border border-orange-100">
                        <h2 class="text-xs font-black text-orange-400 uppercase tracking-widest mb-3">Cara Pengolahan</h2>
                        <p class="text-orange-900 leading-relaxed text-sm italic">"{{ $plant->cara_olah }}"</p>
                    </div>

                    <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100 flex gap-4 items-start">
                        <span class="text-2xl">ℹ️</span>
                        <div>
                            <p class="text-[10px] font-bold text-blue-400 uppercase mb-1">Catatan Medis</p>
                            <p class="text-xs text-blue-800 leading-tight">Informasi ini bersifat edukatif dan tidak menggantikan konsultasi medis profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>