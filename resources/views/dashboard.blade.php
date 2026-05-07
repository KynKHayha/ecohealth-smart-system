<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Eco Health</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <aside class="w-72 bg-emerald-950 text-white flex flex-col p-8 fixed h-full shadow-2xl z-20">
        <div class="flex items-center gap-3 mb-12">
            <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo PPK" class="w-12 h-12 object-contain group-hover:scale-110 transition duration-300">
            <span class="text-xl font-800 tracking-tighter">EcoHealth</span>
        </div>
            <nav class="flex-grow space-y-4">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 {{ request()->routeIs('dashboard') ? 'bg-white/10 text-emerald-400' : 'text-slate-400 hover:bg-white/5 hover:text-white' }} px-6 py-4 rounded-2xl font-bold transition">
        <span>📊</span> Dasbor Tanaman
    </a>
    
    <a href="{{ route('tips.manage') }}" class="flex items-center gap-4 {{ request()->routeIs('tips.manage') ? 'bg-white/10 text-emerald-400' : 'text-slate-400 hover:bg-white/5 hover:text-white' }} px-6 py-4 rounded-2xl font-bold transition">
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
                <h1 class="text-3xl font-800 text-slate-900 tracking-tight">Ringkasan Sistem</h1>
                <p class="text-slate-500 font-medium">Manajemen Tanaman & Edukasi Desa Mekarjaya</p>
            </div>
            <div class="flex gap-4">
    <a href="{{ route('plant.cetak') }}" class="bg-slate-800 text-white px-6 py-4 rounded-2xl font-800 shadow-xl hover:bg-slate-700 transition-all">
        📄 Cetak PDF
    </a>
    <a href="{{ route('plant.create') }}" class="bg-emerald-600 text-white px-6 py-4 rounded-2xl font-800 shadow-xl hover:bg-emerald-700 transition-all">
        + Tambah Baru
    </a>
</div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <p class="text-xs font-black text-slate-400 uppercase mb-2">Total Spesies</p>
                <h3 class="text-4xl font-800 text-slate-900">{{ $plants->count() }}</h3>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 border-l-4 border-l-emerald-500">
                <p class="text-xs font-black text-emerald-600 uppercase mb-2">Total Stok</p>
                <h3 class="text-4xl font-800 text-slate-900">{{ $total_bibit }}</h3>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 border-l-4 border-l-amber-500">
                <p class="text-xs font-black text-amber-600 uppercase mb-2">Stok Menipis</p>
                <h3 class="text-4xl font-800 text-slate-900">{{ $stok_menipis }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden mb-12">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-800 text-slate-900 text-lg">Daftar Tanaman Obat</h3>
                <div class="flex gap-2">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-xs font-bold {{ !request('rw') ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }}">Semua</a>
                    <a href="{{ route('dashboard', ['rw' => '2']) }}" class="px-4 py-2 rounded-xl text-xs font-bold {{ request('rw') == '2' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }}">RW 02</a>
                    <a href="{{ route('dashboard', ['rw' => '3']) }}" class="px-4 py-2 rounded-xl text-xs font-bold {{ request('rw') == '3' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }}">RW 03</a>
                    <a href="{{ route('dashboard', ['rw' => '4']) }}" class="px-4 py-2 rounded-xl text-xs font-bold {{ request('rw') == '4' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }}">RW 04</a>
                </div>
                <div class="mb-6 relative group">
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <span class="text-slate-400 group-focus-within:text-emerald-500 transition-colors">🔍</span>
    </div>
    <input type="text" id="searchInput" onkeyup="searchTable()" 
        placeholder="Cari nama tanaman atau kategori..." 
        class="w-full bg-white border border-slate-200 rounded-2xl py-4 pl-12 pr-4 text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all shadow-sm">
</div>
            </div>
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-6">Tanaman</th>
                        <th class="px-8 py-6">Lokasi</th>
                        <th class="px-8 py-6 text-center">Stok</th>
                        <th class="px-8 py-6">Status</th>
                        <th class="px-8 py-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($plants as $p)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-100">
                                    @if($p->image)
                                        <img src="{{ asset('images/plants/' . $p->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-lg">🌿</div>
                                    @endif
                                </div>
                                <span class="font-bold text-slate-900 text-sm">{{ $p->nama_tanaman }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-xs font-bold text-slate-500">🏡 RW 0{{ $p->rw }}</td>
                        <td class="px-8 py-6 text-center font-black text-slate-900">{{ $p->stok }}</td>
                        <td class="px-8 py-6">
                            @if($p->stok <= $p->min_stok)
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">Menipis</span>
                            @else
                                <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">Aman</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex justify-center gap-4">
                                <a href="{{ route('plant.edit', $p->id) }}" class="text-emerald-600 hover:text-emerald-800 font-bold text-xs">Edit</a>
                                <form action="{{ route('plant.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600 font-bold text-xs">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    <script>
        function openModalTip() { document.getElementById('modalTip').classList.remove('hidden'); }
        function closeModalTip() { document.getElementById('modalTip').classList.add('hidden'); }
    </script>
    <script>
function searchTable() {
    // Ambil input dan ubah jadi huruf kecil (biar gak sensitif huruf besar/kecil)
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.querySelector("table"); // Pastikan ini target ke tabel tanaman
    let tr = table.getElementsByTagName("tr");

    // Loop semua baris tabel (mulai dari baris ke-1 karena ke-0 itu header)
    for (let i = 1; i < tr.length; i++) {
        let tdNama = tr[i].getElementsByTagName("td")[0]; // Kolom Nama Tanaman
        let tdKategori = tr[i].getElementsByTagName("td")[2]; // Kolom Kategori (Sesuaikan urutan kolommu)
        
        if (tdNama || tdKategori) {
            let txtNama = tdNama.textContent || tdNama.innerText;
            let txtKategori = tdKategori.textContent || tdKategori.innerText;
            
            // Cek apakah ada kata yang cocok di nama atau kategori
            if (txtNama.toLowerCase().indexOf(filter) > -1 || txtKategori.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = ""; // Munculkan
            } else {
                tr[i].style.display = "none"; // Sembunyikan
            }
        }
    }
}
</script>
</body>
</html>

