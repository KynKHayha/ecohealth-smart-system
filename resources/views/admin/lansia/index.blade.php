@extends('layouts.admin')
@section('title', 'Data Lansia Mekarjaya')

@section('head')
<style>
    .custom-scroll::-webkit-scrollbar { height: 4px; width: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
</style>
@endsection

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">👴 Data Lansia Mekarjaya</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Monitoring kesehatan warga lanjut usia secara real-time</p>
    </div>
    <div class="flex flex-wrap items-center gap-3 flex-shrink-0">
        {{-- Export CSV --}}
        <a href="{{ route('lansia.export') }}" class="flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-bold text-sm shadow-lg shadow-blue-500/20 transition-all">
            📥 Export CSV
        </a>
        {{-- Import CSV --}}
        <form action="{{ route('lansia.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <label class="group flex items-center gap-2 bg-white dark:bg-slate-800 border-2 border-dashed border-slate-200 dark:border-slate-600 px-4 py-2.5 rounded-2xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all">
                <span class="text-lg">📄</span>
                <div class="text-left hidden sm:block">
                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Import CSV</p>
                    <p id="fileName" class="text-xs font-bold text-slate-600 dark:text-slate-300">Pilih file...</p>
                </div>
                <input type="file" name="file_csv" class="hidden" accept=".csv" required
                    onchange="document.getElementById('fileName').innerText = this.files[0].name; document.getElementById('importBtn').click()">
            </label>
            <button id="importBtn" type="submit" class="hidden"></button>
        </form>

        <button onclick="openModal()"
            class="flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-500/20 transition-all">
            + Tambah Warga
        </button>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Total Warga</p>
            <h3 class="text-4xl font-black text-slate-900 dark:text-white">{{ $lansias->count() }}</h3>
        </div>
        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-2xl">👥</div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm border-l-4 border-l-rose-500 flex items-center justify-between">
        <div>
            <p class="text-xs font-black text-rose-600 uppercase tracking-widest mb-1">Butuh Perhatian</p>
            <h3 class="text-4xl font-black text-slate-900 dark:text-white">{{ $lansias->where('penyakit', '!=', 'tidak ada')->count() }}</h3>
        </div>
        <div class="w-12 h-12 bg-rose-50 dark:bg-rose-900/30 rounded-2xl flex items-center justify-center text-2xl">⚠️</div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm border-l-4 border-l-emerald-500 flex items-center justify-between">
        <div>
            <p class="text-xs font-black text-emerald-600 uppercase tracking-widest mb-1">Kondisi Sehat</p>
            <h3 class="text-4xl font-black text-slate-900 dark:text-white">{{ $lansias->where('penyakit', 'tidak ada')->count() }}</h3>
        </div>
        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center text-2xl">💚</div>
    </div>
</div>

{{-- Bulk Delete Bar --}}
<div id="bulkBar" class="hidden mb-5 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-2xl flex items-center justify-between gap-4">
    <div class="flex items-center gap-3">
        <span class="text-xl">📝</span>
        <p class="text-sm font-bold text-amber-900 dark:text-amber-200"><span id="selectedCount">0</span> warga dipilih</p>
    </div>
    <form action="{{ route('lansia.bulkDelete') }}" method="POST" onsubmit="return confirm('Hapus warga yang dipilih?')">
        @csrf @method('DELETE')
        <input type="hidden" name="ids" id="selectedIdsInput">
        <button type="submit" class="px-5 py-2 bg-rose-600 text-white rounded-xl font-bold text-xs hover:bg-rose-700 transition">🗑️ Hapus Terpilih</button>
    </form>
</div>

{{-- Search + Filter --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm mb-6">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-grow">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
            <input type="text" id="searchInput" onkeyup="searchTable()"
                placeholder="Cari nama, NIK, atau alamat..."
                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
        </div>
        <div class="flex items-center gap-2 flex-shrink-0 overflow-x-auto">
            <button onclick="filterTable('all')" class="filter-btn active px-4 py-2 rounded-xl text-xs font-bold bg-emerald-600 text-white whitespace-nowrap transition-all">Semua</button>
            <button onclick="filterTable('hipertensi')" class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 whitespace-nowrap transition-all">Hipertensi</button>
            <button onclick="filterTable('diabetes')" class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 whitespace-nowrap transition-all">Diabetes</button>
            <button onclick="filterTable('asam urat')" class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 whitespace-nowrap transition-all">Asam Urat</button>
            <button onclick="filterTable('tidak ada')" class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 whitespace-nowrap transition-all">Sehat</button>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden mb-8">
    <div class="overflow-x-auto custom-scroll">
        <table id="lansiaTable" class="w-full text-left min-w-[700px]">
            <thead class="bg-slate-50 dark:bg-slate-700/50 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                <tr>
                    <th class="px-5 py-4 text-center">
                        <input type="checkbox" id="selectAll" class="w-4 h-4 rounded accent-emerald-600 cursor-pointer">
                    </th>
                    <th class="px-5 py-4">Profil Warga</th>
                    <th class="px-5 py-4">Kondisi Kesehatan</th>
                    <th class="px-5 py-4">Rekomendasi Herbal</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                @forelse($lansias as $l)
                @php
                    $isHealthy = strtolower($l->penyakit) == 'tidak ada';
                    $pLower = strtolower($l->penyakit);
                    $keyword = '';
                    if(str_contains($pLower, 'hipertensi')) $keyword = 'Kumis Kucing';
                    elseif(str_contains($pLower, 'asam urat')) $keyword = 'Jahe';
                    elseif(str_contains($pLower, 'diabetes')) $keyword = 'Sambiloto';
                    elseif(str_contains($pLower, 'kolesterol')) $keyword = 'Daun Salam';
                    $stokTanaman = $keyword ? $plants->where('nama_tanaman', $keyword)->first() : null;
                @endphp
                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors">
                    {{-- Checkbox --}}
                    <td class="px-5 py-5 text-center">
                        <input type="checkbox" class="lansia-checkbox w-4 h-4 rounded accent-emerald-600 cursor-pointer" value="{{ $l->id }}">
                    </td>

                    {{-- Profil --}}
                    <td class="px-5 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                                {{ strtoupper(substr($l->nama, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white text-sm">{{ $l->nama }}</p>
                                <div class="flex items-center gap-2 mt-0.5 flex-wrap">
                                    <span class="font-mono text-[11px] text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded-lg">{{ $l->nik }}</span>
                                    <span class="text-[11px] text-slate-400 dark:text-slate-500">📍 {{ $l->alamat }}</span>
                                    <span class="text-[11px] text-slate-400 dark:text-slate-500">RW 0{{ $l->rw }}</span>
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- Penyakit --}}
                    <td class="px-5 py-5">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(explode(',', $l->penyakit) as $p)
                            <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wide
                                {{ $isHealthy ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400' : 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400' }}">
                                {{ trim($p) }}
                            </span>
                            @endforeach
                        </div>
                    </td>

                    {{-- Rekomendasi --}}
                    <td class="px-5 py-5">
                        @if($keyword)
                        <div class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-2xl border
                            {{ $stokTanaman && $stokTanaman->stok > 0 ? 'bg-emerald-50 dark:bg-emerald-900/20 border-emerald-100 dark:border-emerald-800/50' : 'bg-rose-50 dark:bg-rose-900/20 border-rose-100 dark:border-rose-800/50' }}">
                            <span class="text-lg">🌿</span>
                            <div>
                                <p class="text-sm font-black text-slate-800 dark:text-slate-200">{{ $keyword }}</p>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $stokTanaman && $stokTanaman->stok > 0 ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></div>
                                    <p class="text-[10px] font-bold text-slate-500 dark:text-slate-400">Stok: {{ $stokTanaman->stok ?? 0 }} bibit</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <span class="text-slate-400 dark:text-slate-500 text-xs italic flex items-center gap-1.5"><span>🩺</span> Konsultasi lanjut</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="px-5 py-5">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('lansia.kartu', $l->id) }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all text-sm" title="Cetak Kartu">🖨️</a>
                            <form action="{{ route('lansia.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Hapus {{ $l->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 text-rose-400 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all text-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-16 text-center">
                        <div class="text-5xl mb-3">👥</div>
                        <p class="font-black text-slate-900 dark:text-white mb-1">Belum Ada Data Lansia</p>
                        <p class="text-sm text-slate-400 dark:text-slate-500">Tambah manual atau import via CSV</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pusat Kendali Data --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-11 h-11 bg-rose-50 dark:bg-rose-900/30 rounded-2xl flex items-center justify-center text-xl">🛡️</div>
        <div>
            <h4 class="font-black text-slate-900 dark:text-white">Pusat Kendali Data</h4>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">Opsi penghapusan cerdas — gunakan dengan hati-hati</p>
        </div>
    </div>
    <div class="space-y-3">
        <form action="{{ route('lansia.recentManual') }}" method="POST"
            class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-700/50 rounded-2xl hover:bg-amber-50 dark:hover:bg-amber-900/20 transition group">
            @csrf @method('DELETE')
            <div>
                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Batalkan Input Manual</p>
                <p class="text-[10px] text-slate-400 dark:text-slate-500 uppercase font-black tracking-widest">5 menit terakhir</p>
            </div>
            <button type="submit" class="px-4 py-2 bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400 rounded-xl text-[11px] font-black hover:bg-amber-200 dark:hover:bg-amber-800/40 transition">Undo ↩️</button>
        </form>

        <form action="{{ route('lansia.recentImport') }}" method="POST"
            class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-700/50 rounded-2xl hover:bg-orange-50 dark:hover:bg-orange-900/20 transition">
            @csrf @method('DELETE')
            <div>
                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Hapus Import CSV Terakhir</p>
                <p class="text-[10px] text-slate-400 dark:text-slate-500 uppercase font-black tracking-widest">Rollback satu file</p>
            </div>
            <button type="submit" class="px-4 py-2 bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-400 rounded-xl text-[11px] font-black hover:bg-orange-200 dark:hover:bg-orange-800/40 transition">Rollback 📂</button>
        </form>

        <form action="{{ route('lansia.truncate') }}" method="POST"
            onsubmit="return confirm('⚠️ PERHATIAN: Seluruh data lansia akan DIHAPUS PERMANEN! Yakin?')">
            @csrf @method('DELETE')
            <button type="submit"
                class="w-full py-4 bg-rose-600 hover:bg-rose-700 text-white rounded-2xl font-black text-sm shadow-lg shadow-rose-500/20 hover:scale-[1.01] active:scale-[0.99] transition-all">
                💥 Kosongkan Seluruh Tabel Data
            </button>
        </form>
    </div>
</div>

{{-- ===== MODAL TAMBAH WARGA ===== --}}
<div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4" onclick="if(event.target===this)closeModal()">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"></div>
    <div class="relative bg-white dark:bg-slate-800 w-full max-w-lg rounded-3xl p-8 shadow-2xl border border-slate-100 dark:border-slate-700">
        <div class="flex items-center justify-between mb-7">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center text-2xl">👴</div>
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">Tambah Data Warga</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">Data Lansia Baru</p>
                </div>
            </div>
            <button onclick="closeModal()" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600 transition font-bold text-lg leading-none">✕</button>
        </div>

        <form action="{{ route('lansia.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Nama Lengkap *</label>
                <input type="text" name="nama" required placeholder="Nama lengkap warga"
                    class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">NIK *</label>
                    <input type="number" name="nik" required placeholder="Nomor NIK"
                        class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Wilayah RW *</label>
                    <select name="rw" required
                        class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all appearance-none">
                        <option value="2">📍 RW 02</option>
                        <option value="3">📍 RW 03</option>
                        <option value="4">📍 RW 04</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Riwayat Penyakit *</label>
                <input type="text" name="penyakit" required placeholder="Contoh: Hipertensi, Asam Urat (atau 'tidak ada')"
                    class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Alamat *</label>
                <textarea name="alamat" required rows="2" placeholder="Alamat lengkap..."
                    class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all resize-none"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal()" class="flex-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold py-3.5 rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-600 transition text-sm">Batal</button>
                <button type="submit" class="flex-[2] bg-emerald-600 hover:bg-emerald-500 text-white font-black py-3.5 rounded-2xl shadow-lg shadow-emerald-500/20 transition-all hover:scale-[1.02] text-sm">💾 Simpan Data</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openModal() {
    const m = document.getElementById('modal');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    const m = document.getElementById('modal');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}

function searchTable() {
    const filter = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#lansiaTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
}

function filterTable(keyword) {
    document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('bg-emerald-600','text-white');
        b.classList.add('bg-slate-100','dark:bg-slate-700','text-slate-600','dark:text-slate-300');
    });
    event.target.classList.add('bg-emerald-600','text-white');
    event.target.classList.remove('bg-slate-100','dark:bg-slate-700','text-slate-600','dark:text-slate-300');

    document.querySelectorAll('#lansiaTable tbody tr').forEach(row => {
        row.style.display = (keyword === 'all' || row.textContent.toLowerCase().includes(keyword)) ? '' : 'none';
    });
}

// Checkbox bulk select
const selectAll = document.getElementById('selectAll');
if (selectAll) {
    selectAll.addEventListener('change', () => {
        document.querySelectorAll('.lansia-checkbox').forEach(cb => cb.checked = selectAll.checked);
        updateBulkBar();
    });
}
document.addEventListener('change', e => {
    if (e.target.classList.contains('lansia-checkbox')) updateBulkBar();
});
function updateBulkBar() {
    const checked = document.querySelectorAll('.lansia-checkbox:checked');
    const bar = document.getElementById('bulkBar');
    if (checked.length > 0) {
        bar.classList.remove('hidden'); bar.classList.add('flex');
        document.getElementById('selectedCount').textContent = checked.length;
        document.getElementById('selectedIdsInput').value = Array.from(checked).map(cb => cb.value).join(',');
    } else {
        bar.classList.add('hidden'); bar.classList.remove('flex');
        if (selectAll) selectAll.checked = false;
    }
}
</script>
@endsection
