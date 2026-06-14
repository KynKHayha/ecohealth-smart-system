@extends('layouts.admin')
@section('title', 'Dasbor Tanaman')

@section('content')
{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Ringkasan Sistem</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Manajemen Tanaman & Edukasi Desa Mekarjaya</p>
    </div>
    <div class="flex items-center gap-3 flex-shrink-0">
        <a href="{{ route('plant.cetak') }}" class="flex items-center gap-2 px-5 py-3 bg-slate-800 dark:bg-slate-700 text-white rounded-2xl font-bold text-sm hover:bg-slate-700 dark:hover:bg-slate-600 transition-all shadow-lg">
            📄 Cetak PDF
        </a>
        <a href="{{ route('plant.create') }}" class="flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-500/20">
            + Tambah Tanaman
        </a>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Total Spesies</p>
            <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-xl">🌿</div>
        </div>
        <h3 class="text-4xl font-black text-slate-900 dark:text-white">{{ $plants->count() }}</h3>
        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1 font-medium">Jenis tanaman terdaftar</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm border-l-4 border-l-emerald-500">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-black text-emerald-600 uppercase tracking-widest">Total Stok Bibit</p>
            <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center text-xl">🌱</div>
        </div>
        <h3 class="text-4xl font-black text-slate-900 dark:text-white">{{ $total_bibit }}</h3>
        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1 font-medium">Total bibit tersedia</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl p-7 border border-slate-100 dark:border-slate-700 shadow-sm border-l-4 border-l-amber-500">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-black text-amber-600 uppercase tracking-widest">Stok Menipis</p>
            <div class="w-10 h-10 bg-amber-50 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center text-xl">⚠️</div>
        </div>
        <h3 class="text-4xl font-black text-slate-900 dark:text-white">{{ $stok_menipis }}</h3>
        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1 font-medium">Perlu pengisian ulang</p>
    </div>
</div>

{{-- Plants Table --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
    {{-- Table Header --}}
    <div class="p-6 border-b border-slate-50 dark:border-slate-700 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="font-black text-slate-900 dark:text-white">Daftar Tanaman Obat</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-medium mt-0.5">Semua koleksi TOGA Desa Mekarjaya</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            {{-- RW Filter --}}
            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-xl text-xs font-bold {{ !request('rw') ? 'bg-emerald-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} transition-all">Semua</a>
            <a href="{{ route('dashboard', ['rw'=>'2']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold {{ request('rw')=='2' ? 'bg-emerald-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} transition-all">RW 02</a>
            <a href="{{ route('dashboard', ['rw'=>'3']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold {{ request('rw')=='3' ? 'bg-emerald-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} transition-all">RW 03</a>
            <a href="{{ route('dashboard', ['rw'=>'4']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold {{ request('rw')=='4' ? 'bg-emerald-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} transition-all">RW 04</a>

            {{-- Search --}}
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔍</span>
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari tanaman..."
                    class="pl-9 pr-4 py-1.5 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-xs font-medium text-slate-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all w-40 sm:w-48">
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[640px]" id="plantsTable">
            <thead class="bg-slate-50 dark:bg-slate-700/50 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4">Tanaman</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Lokasi</th>
                    <th class="px-6 py-4 text-center">Stok</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                @forelse($plants as $p)
                <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-700/30 transition-colors">
                    {{-- Tanaman --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-700 flex-shrink-0">
                                @if($p->image)
                                <img src="{{ asset('images/plants/' . $p->image) }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-lg">🌿</div>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white text-sm">{{ $p->nama_tanaman }}</p>
                                <p class="text-xs italic text-slate-400 dark:text-slate-500">{{ $p->nama_latin }}</p>
                            </div>
                        </div>
                    </td>
                    {{-- Kategori --}}
                    <td class="px-6 py-4">
                        <span class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 px-2.5 py-1 rounded-lg text-[11px] font-black">{{ $p->kategori }}</span>
                    </td>
                    {{-- Lokasi --}}
                    <td class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400">📍 RW 0{{ $p->rw }}</td>
                    {{-- Stok --}}
                    <td class="px-6 py-4 text-center font-black text-slate-900 dark:text-white">{{ $p->stok }}</td>
                    {{-- Status --}}
                    <td class="px-6 py-4">
                        @if($p->stok <= $p->min_stok)
                        <span class="bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 px-3 py-1 rounded-full text-[10px] font-black uppercase">Menipis</span>
                        @else
                        <span class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 px-3 py-1 rounded-full text-[10px] font-black uppercase">Aman</span>
                        @endif
                    </td>
                    {{-- Aksi --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('plant.print', $p->id) }}" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-lg text-xs font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition" title="Print QR">🏷️</a>
                            <a href="{{ route('plant.edit', $p->id) }}" class="px-3 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-lg text-xs font-bold hover:bg-emerald-100 dark:hover:bg-emerald-800/30 transition">Edit</a>
                            <form action="{{ route('plant.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus tanaman {{ $p->nama_tanaman }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 rounded-lg text-xs font-bold hover:bg-red-100 dark:hover:bg-red-900/30 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-slate-400 dark:text-slate-500">
                        <div class="text-5xl mb-3">🌿</div>
                        <p class="font-bold">Belum ada data tanaman</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
function searchTable() {
    const filter = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#plantsTable tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}
</script>
@endsection