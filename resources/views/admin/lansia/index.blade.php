<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lansia | EcoHealth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <aside class="w-72 bg-[#062C26] text-white flex flex-col p-8 fixed h-full shadow-2xl">
        <div class="flex items-center gap-3 mb-12">
            <img src="{{ asset('images/Logo_ppk.jpeg') }}" alt="Logo" class="w-10 h-10 object-contain">
            <span class="text-xl font-800 tracking-tighter text-emerald-400">EcoHealth</span>
        </div>
        <nav class="flex-grow space-y-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-slate-400 hover:bg-white/5 px-6 py-4 rounded-2xl font-bold transition">
                <span>📊</span> Dasbor
            </a>
            <a href="{{ route('tips.manage') }}" class="flex items-center gap-4 text-slate-400 hover:bg-white/5 px-6 py-4 rounded-2xl font-bold transition">
                <span>💡</span> Tips Kesehatan
            </a>
            <a href="{{ route('lansia.index') }}" class="flex items-center gap-4 bg-white/10 text-emerald-400 px-6 py-4 rounded-2xl font-bold border border-white/5 shadow-lg">
                <span>👴</span> Data Lansia
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
        <header class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-800 text-slate-900 tracking-tight">Data Lansia Mekarjaya</h1>
                <p class="text-slate-500 font-medium text-base mt-1">Monitoring kesehatan warga lanjut usia secara real-time</p>
            </div>
            <div class="flex items-center gap-4">
                <form action="{{ route('lansia.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <label class="group flex items-center gap-3 bg-white border-2 border-dashed border-slate-200 px-6 py-3 rounded-2xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50 transition-all">
                        <span class="text-xl">📄</span>
                        <div class="text-left">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Import CSV</p>
                            <p id="fileName" class="text-xs font-bold text-slate-600">Pilih file...</p>
                        </div>
                        <input type="file" name="file_csv" class="hidden" accept=".csv" required onchange="document.getElementById('fileName').innerText = this.files[0].name">
                    </label>
                    <button type="submit" class="bg-amber-500 text-white p-4 rounded-2xl font-bold shadow-lg hover:bg-amber-600 transition-all">🚀</button>
                </form>
                <button onclick="openModalLansia()" class="bg-emerald-600 text-white px-8 py-5 rounded-2xl font-800 shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition-all">
                    + Tambah Lansia
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Total Warga Terdata</p>
                    <h3 class="text-5xl font-800 text-slate-900">{{ $lansias->count() }}</h3>
                </div>
                <div class="w-16 h-16 bg-emerald-50 rounded-3xl flex items-center justify-center text-3xl">👥</div>
            </div>
            <div class="bg-rose-50 p-10 rounded-[3rem] border border-rose-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-rose-600 uppercase mb-2 tracking-widest">Butuh Perhatian Medis</p>
                    <h3 class="text-5xl font-800 text-rose-700">{{ $lansias->where('penyakit', '!=', 'tidak ada')->count() }}</h3>
                </div>
                <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-3xl">⚠️</div>
            </div>
        </div>

        <div id="bulkDeleteSection" class="hidden mb-6 p-6 bg-amber-50 border border-amber-200 rounded-[2.5rem] items-center justify-between shadow-sm animate-in slide-in-from-top duration-300">
            <div class="flex items-center gap-4">
                <span class="text-2xl">📝</span>
                <div>
                    <p class="text-sm font-black text-amber-900 uppercase tracking-widest">Tindakan Massal</p>
                    <p class="text-xs font-bold text-amber-700"><span id="selectedCount">0</span> warga terpilih</p>
                </div>
            </div>
            <form action="{{ route('lansia.bulkDelete') }}" method="POST" onsubmit="return confirm('Hapus warga yang dicentang?')">
                @csrf @method('DELETE')
                <input type="hidden" name="ids" id="selectedIdsInput">
                <button type="submit" class="bg-rose-600 text-white px-8 py-3 rounded-xl font-800 text-xs shadow-lg hover:bg-rose-700 transition-all">
                    🗑️ Hapus Terpilih
                </button>
            </form>
        </div>

        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100 mb-8">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-4">Filter Cepat Riwayat Penyakit:</p>
            <div class="flex flex-wrap gap-3 overflow-x-auto pb-4 custom-scrollbar mb-6">
                
            </div>

            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-xl">🔍</div>
                <input type="text" id="searchInput" onkeyup="searchGlobal()" 
                    placeholder="Ketik Nama, NIK, atau Alamat untuk mencari..." 
                    class="w-full pl-14 pr-6 py-5 bg-slate-50 border border-slate-100 rounded-[2rem] focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all text-base font-semibold text-slate-700 placeholder:text-slate-400">
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden mb-12">
            <table id="lansiaTable" class="w-full text-left">
                <thead class="bg-slate-50/50 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">
                    <tr>
                        <th class="px-6 py-8 text-center">
                            <input type="checkbox" id="selectAll" class="w-5 h-5 rounded cursor-pointer accent-emerald-600">
                        </th>
                        <th class="px-10 py-8">Profil Warga</th>
                        <th class="px-10 py-8">Kondisi Kesehatan</th>
                        <th class="px-10 py-8">Rekomendasi Herbal</th>
                        <th class="px-10 py-8 text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($lansias as $l)
                    <tr class="group hover:bg-emerald-50/40 transition-all duration-300">
                        <td class="px-6 py-10 text-center">
                            <input type="checkbox" class="lansia-checkbox w-5 h-5 rounded cursor-pointer accent-emerald-600" value="{{ $l->id }}">
                        </td>
                        <td class="px-10 py-10">
                            <div class="flex flex-col">
                                <span class="text-xl font-800 text-slate-900 group-hover:text-emerald-700 transition-colors tracking-tight">
                                    {{ $l->nama }}
                                </span>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 font-mono text-[12px] rounded-lg tracking-widest font-bold">
                                        {{ $l->nik }}
                                    </span>
                                    <span class="text-sm text-slate-400 font-medium">📍 {{ $l->alamat }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-10">
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $isHealthy = strtolower($l->penyakit) == 'tidak ada';
                                    $penyakitList = explode(',', $l->penyakit);
                                @endphp
                                @foreach($penyakitList as $p)
                                <span class="px-5 py-2 {{ $isHealthy ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} rounded-2xl text-[12px] font-black uppercase tracking-wider shadow-sm">
                                    {{ trim($p) }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-10 py-10">
                            @php
                                $keyword = '';
                                $pLower = strtolower($l->penyakit);
                                if(str_contains($pLower, 'hipertensi')) $keyword = 'Kumis Kucing';
                                elseif(str_contains($pLower, 'asam urat')) $keyword = 'Jahe';
                                elseif(str_contains($pLower, 'kolestrol')) $keyword = 'Daun Salam';
                                $stok_tanaman = $plants->where('nama_tanaman', $keyword)->first();
                            @endphp

                            @if($keyword != '')
                                <div class="inline-flex flex-col p-5 rounded-[2rem] border-2 bg-white {{ $stok_tanaman && $stok_tanaman->stok > 0 ? 'border-emerald-100' : 'border-rose-100' }} min-w-[200px] shadow-sm">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">💡 Saran Herbal</p>
                                        <span class="text-xl">🌿</span>
                                    </div>
                                    <p class="text-base font-800 text-slate-800">{{ $keyword }}</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="w-2.5 h-2.5 rounded-full {{ $stok_tanaman && $stok_tanaman->stok > 0 ? 'bg-emerald-500' : 'bg-rose-500' }} animate-pulse"></div>
                                        <p class="text-xs font-bold text-slate-500">Persediaan: {{ $stok_tanaman->stok ?? 0 }} Bibit</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center gap-3 text-slate-300 italic py-2">
                                    <span class="text-2xl">🩺</span>
                                    <span class="text-sm font-bold tracking-tight uppercase">Konsultasi Lanjut</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-10 py-10 text-right">
                            <div class="flex justify-end items-center gap-4">
                                <a href="{{ route('lansia.kartu', $l->id) }}" target="_blank" 
                                   class="flex items-center justify-center w-14 h-14 bg-white border border-slate-100 text-slate-500 rounded-2xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                    <span class="text-xl">🖨️</span>
                                </a>
                                <form action="{{ route('lansia.destroy', $l->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus warga ini?')" 
                                            class="flex items-center justify-center w-14 h-14 bg-white border border-slate-100 text-rose-400 rounded-2xl hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                        <span class="text-xl">🗑️</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-12 mb-20">
            <div class="bg-white p-10 rounded-[3.5rem] border border-slate-100 shadow-xl max-w-2xl w-full">
                <div class="flex items-center gap-4 mb-8">
                    <span class="text-3xl">🛡️</span>
                    <div>
                        <h4 class="text-xl font-800 text-slate-900 tracking-tight">Pusat Kendali Data</h4>
                        <p class="text-sm text-slate-400 font-medium">Opsi penghapusan cerdas</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <form action="{{ route('lansia.recentManual') }}" method="POST" class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-amber-50 transition">
                        @csrf @method('DELETE')
                        <div>
                            <p class="text-sm font-bold text-slate-700">Batalkan Input Manual</p>
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">5 Menit Terakhir</p>
                        </div>
                        <button type="submit" class="bg-amber-100 text-amber-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-tighter">Undo ↩️</button>
                    </form>

                    <form action="{{ route('lansia.recentImport') }}" method="POST" class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-orange-50 transition">
                        @csrf @method('DELETE')
                        <div>
                            <p class="text-sm font-bold text-slate-700">Hapus Import CSV Terakhir</p>
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">Rollback Satu File</p>
                        </div>
                        <button type="submit" class="bg-orange-100 text-orange-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-tighter">Rollback 📂</button>
                    </form>

                    <form action="{{ route('lansia.truncate') }}" method="POST" onsubmit="return confirm('PERHATIAN: Seluruh data akan dihapus permanen!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full mt-4 py-5 bg-rose-600 text-white rounded-[1.5rem] font-800 shadow-lg shadow-rose-100 hover:bg-rose-700 transition active:scale-95">
                            💥 KOSONGKAN SELURUH TABEL
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <div id="modalLansia" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xl z-50 hidden items-center justify-center p-6">
        <div class="bg-white w-full max-w-xl rounded-[3.5rem] p-12 shadow-2xl animate-in zoom-in-95 duration-300">
            <h3 class="text-3xl font-800 text-slate-900 mb-8 tracking-tight">Tambah Data Warga</h3>
            <form action="{{ route('lansia.store') }}" method="POST" class="space-y-5">
                @csrf
                <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full bg-slate-50 border-none rounded-[1.5rem] p-5 text-base font-bold outline-none focus:ring-2 focus:ring-emerald-500" required>
                <div class="grid grid-cols-2 gap-5">
                    <input type="number" name="nik" placeholder="NIK" class="w-full bg-slate-50 border-none rounded-[1.5rem] p-5 text-base font-bold outline-none focus:ring-2 focus:ring-emerald-500" required>
                    <select name="rw" class="w-full bg-slate-50 border-none rounded-[1.5rem] p-5 text-base font-bold outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="2">RW 02</option>
                        <option value="3">RW 03</option>
                        <option value="4">RW 04</option>
                    </select>
                </div>
                <input type="text" name="penyakit" placeholder="Penyakit" class="w-full bg-slate-50 border-none rounded-[1.5rem] p-5 text-base font-bold outline-none focus:ring-2 focus:ring-emerald-500" required>
                <textarea name="alamat" placeholder="Alamat lengkap..." rows="3" class="w-full bg-slate-50 border-none rounded-[1.5rem] p-5 text-base font-medium outline-none focus:ring-2 focus:ring-emerald-500" required></textarea>
                <div class="flex gap-4 pt-6">
                    <button type="button" onclick="closeModalLansia()" class="flex-1 bg-slate-100 text-slate-500 font-800 py-5 rounded-2xl">Batal</button>
                    <button type="submit" class="flex-[2] bg-emerald-600 text-white font-800 py-5 rounded-2xl shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalLansia() {
            document.getElementById('modalLansia').classList.replace('hidden', 'flex');
        }
        function closeModalLansia() {
            document.getElementById('modalLansia').classList.replace('flex', 'hidden');
        }

        function searchGlobal() {
            let filter = document.getElementById("searchInput").value.toLowerCase();
            let tr = document.querySelectorAll("#lansiaTable tbody tr");
            tr.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
            });
        }

        function filterTable(penyakit) {
            let tr = document.querySelectorAll("#lansiaTable tbody tr");
            tr.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = (penyakit === 'all' || text.includes(penyakit)) ? "" : "none";
            });
        }

        // LOGIKA CHECKBOX & BULK DELETE
        const selectAll = document.getElementById('selectAll');
        const bulkSection = document.getElementById('bulkDeleteSection');
        const selectedCountText = document.getElementById('selectedCount');
        const selectedIdsInput = document.getElementById('selectedIdsInput');

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.lansia-checkbox');
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                updateBulkStatus();
            });
        }

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('lansia-checkbox')) {
                updateBulkStatus();
            }
        });

        function updateBulkStatus() {
            const checked = document.querySelectorAll('.lansia-checkbox:checked');
            if (checked.length > 0) {
                bulkSection.classList.replace('hidden', 'flex');
                selectedCountText.innerText = checked.length;
                const ids = Array.from(checked).map(cb => cb.value);
                selectedIdsInput.value = ids.join(',');
            } else {
                bulkSection.classList.replace('flex', 'hidden');
                if (selectAll) selectAll.checked = false;
            }
        }
    </script>
</body>
</html>