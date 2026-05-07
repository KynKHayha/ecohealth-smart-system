<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tips | EcoHealth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <aside class="w-72 bg-[#062C26] text-white flex flex-col p-8 fixed h-full shadow-2xl">
        <div class="flex items-center gap-3 mb-12">
            <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
            <span class="text-xl font-800 tracking-tighter text-white">EcoHealth</span>
        </div>
        <nav class="flex-grow space-y-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-slate-400 hover:bg-white/5 px-6 py-4 rounded-2xl font-bold transition">
                <span>📊</span> Dasbor
            </a>
            <a href="{{ route('tips.manage') }}" class="flex items-center gap-4 bg-white/10 text-emerald-400 px-6 py-4 rounded-2xl font-bold border border-white/5">
                <span>💡</span> Tips Kesehatan
            </a>
              <a href="{{ route('lansia.index') }}" class="flex items-center gap-4 {{ request()->routeIs('lansia.*') ? 'bg-white/10 text-emerald-400' : 'text-slate-400 hover:bg-white/5' }} px-6 py-4 rounded-2xl font-bold transition">
    <span>👴</span> Data Lansia & Penyakit
</a>
        </nav>

                <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 hover:bg-red-500/20 px-6 py-4 rounded-2xl text-red-400 transition font-bold">
                <span>🚪</span> Keluar
            </button>
        </form>
    </aside>

    <main class="flex-grow ml-72 p-12">
        <header class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-3xl font-800 text-slate-900 tracking-tight">Manajemen Tips</h1>
                <p class="text-slate-500 font-medium text-sm">Kelola konten edukasi untuk warga</p>
            </div>
            <button onclick="openModalTip()" class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-800 shadow-xl hover:bg-emerald-700 transition-all">
                + Tambah Tips Baru
            </button>
        </header>

        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-6">Ikon</th>
                        <th class="px-8 py-6">Judul Tips</th>
                        <th class="px-8 py-6">Kategori</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @foreach($tips as $t)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 text-2xl">{{ $t->icon }}</td>
                        <td class="px-8 py-6 font-bold text-slate-900">{{ $t->judul }}</td>
                        <td class="px-8 py-6">
                            <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">{{ $t->tag }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <form action="{{ route('tips.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-xs uppercase">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <div id="modalTip" class="fixed inset-0 bg-slate-900/40 backdrop-blur-md z-50 hidden items-center justify-center p-6 transition-all duration-300">
        <div class="bg-white w-full max-w-xl rounded-[3rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.2)] transform transition-all animate-in zoom-in-95 duration-300">
            
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-2xl">💡</div>
                <div>
                    <h3 class="text-2xl font-800 text-slate-900 tracking-tight">Tambah Tips Baru</h3>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Edukasi Kesehatan Digital</p>
                </div>
            </div>

            <form action="{{ route('tips.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block">Judul Edukasi</label>
                    <input type="text" name="judul" placeholder="Contoh: Waktu Terbaik Minum Herbal" 
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl p-4 text-sm font-bold text-slate-700 transition-all outline-none" required>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block">Ikon Emoji</label>
                        <input type="text" name="icon" placeholder="⏰" 
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl p-4 text-center text-xl outline-none" required>
                    </div>
                    <div class="col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block">Kategori / Tag</label>
                        <input type="text" name="tag" placeholder="Edukasi / Perawatan" 
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl p-4 text-sm font-bold text-slate-700 outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block">Isi Konten Tips</label>
                    <textarea name="deskripsi" placeholder="Jelaskan secara singkat..." rows="4" 
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-3xl p-5 text-sm font-medium text-slate-600 outline-none" required></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModalTip()" class="flex-1 bg-slate-100 text-slate-500 font-800 py-4 rounded-2xl hover:bg-slate-200 transition-all">Batal</button>
                    <button type="submit" class="flex-[2] bg-emerald-600 text-white font-800 py-4 rounded-2xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">Simpan Tips</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalTip() {
            const modal = document.getElementById('modalTip');
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Paksa tampil pakai flex
        }

        function closeModalTip() {
            const modal = document.getElementById('modalTip');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tutup modal kalau klik di luar kotak putih
        window.onclick = function(event) {
            const modal = document.getElementById('modalTip');
            if (event.target == modal) {
                closeModalTip();
            }
        }
    </script>
</body>
</html>