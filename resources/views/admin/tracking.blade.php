@extends('layouts.admin')
@section('title', 'Manajemen Peta Lokasi')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
    #map { height: 480px; border-radius: 1.5rem; z-index: 0; }
    .dark #map { filter: grayscale(0.3) brightness(0.8); }
    .leaflet-popup-content-wrapper { border-radius: 1rem !important; }
    .leaflet-popup-tip { display: none; }
</style>
@endsection

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">📍 Manajemen Peta Lokasi</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Kelola titik lokasi greenhouse dan area TOGA Desa Mekarjaya</p>
    </div>
    <button onclick="openModal()" class="flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-500/20 transition-all flex-shrink-0">
        + Tambah Lokasi
    </button>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm">
        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Total Titik</p>
        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $locations->count() }}</h3>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm">
        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Greenhouse</p>
        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $locations->where('type','greenhouse')->count() }}</h3>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm">
        <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-1">Waste / Daur Ulang</p>
        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $locations->where('type','waste')->count() }}</h3>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm">
        <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">Lainnya</p>
        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $locations->whereNotIn('type',['greenhouse','waste'])->count() }}</h3>
    </div>
</div>

{{-- Map --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest">Peta Interaktif</h3>
        <span class="text-xs text-slate-400 dark:text-slate-500 font-medium">Klik marker untuk detail lokasi</span>
    </div>
    <div id="map" class="overflow-hidden border border-slate-100 dark:border-slate-700"></div>
</div>

{{-- Locations Table --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-50 dark:border-slate-700">
        <h3 class="font-black text-slate-900 dark:text-white">Daftar Lokasi Terdaftar</h3>
        <p class="text-xs text-slate-400 dark:text-slate-500 font-medium mt-0.5">{{ $locations->count() }} titik lokasi aktif</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[600px]">
            <thead class="bg-slate-50 dark:bg-slate-700/50 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4">Nama Lokasi</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Koordinat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                @forelse($locations as $loc)
                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl flex-shrink-0
                                {{ $loc->type == 'greenhouse' ? 'bg-emerald-50 dark:bg-emerald-900/30' : ($loc->type == 'waste' ? 'bg-rose-50 dark:bg-rose-900/30' : 'bg-blue-50 dark:bg-blue-900/30') }}">
                                @if($loc->type == 'greenhouse') 🌱
                                @elseif($loc->type == 'waste') ♻️
                                @else 🌿 @endif
                            </div>
                            <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $loc->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase
                            {{ $loc->type == 'greenhouse' ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400'
                             : ($loc->type == 'waste' ? 'bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400'
                             : 'bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400') }}">
                            {{ $loc->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-500 dark:text-slate-400">
                        {{ $loc->lat }}, {{ $loc->lng }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="zoomTo('{{ $loc->lat }}','{{ $loc->lng }}')"
                                class="px-3 py-1.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-xs font-bold hover:bg-emerald-100 dark:hover:bg-emerald-900/40 hover:text-emerald-700 dark:hover:text-emerald-400 transition">
                                📍 Lihat
                            </button>
                            <form action="{{ route('location.destroy', $loc->id) }}" method="POST"
                                onsubmit="return confirm('Hapus lokasi {{ $loc->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 rounded-xl text-xs font-bold hover:bg-red-100 dark:hover:bg-red-900/30 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="text-5xl mb-3">📍</div>
                        <p class="font-black text-slate-900 dark:text-white mb-1">Belum Ada Lokasi</p>
                        <p class="text-sm text-slate-400 dark:text-slate-500 mb-5">Tambahkan titik lokasi pertama untuk mulai memetakan area TOGA.</p>
                        <button onclick="openModal()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-500 transition">
                            + Tambah Lokasi
                        </button>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===== MODAL TAMBAH LOKASI ===== --}}
<div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4" onclick="if(event.target===this)closeModal()">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"></div>
    <div class="relative bg-white dark:bg-slate-800 w-full max-w-md rounded-3xl p-8 shadow-2xl border border-slate-100 dark:border-slate-700">
        <div class="flex items-center justify-between mb-7">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center text-2xl">📍</div>
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">Tambah Lokasi Baru</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">Titik Peta Desa</p>
                </div>
            </div>
            <button onclick="closeModal()" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600 transition font-bold text-lg leading-none">✕</button>
        </div>

        <form action="{{ route('location.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Nama Lokasi *</label>
                <input type="text" name="name" required placeholder="Contoh: Greenhouse RW 02"
                    class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Tipe Lokasi *</label>
                <select name="type" required class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-200 outline-none transition-all appearance-none">
                    <option value="greenhouse">🌱 Greenhouse</option>
                    <option value="waste">♻️ Waste / Daur Ulang</option>
                    <option value="other">🌿 Lainnya</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Latitude *</label>
                    <input type="text" name="lat" id="latInput" required placeholder="-6.123456"
                        class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-mono text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5">Longitude *</label>
                    <input type="text" name="lng" id="lngInput" required placeholder="106.123456"
                        class="w-full bg-slate-50 dark:bg-slate-700 border-2 border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl px-4 py-3.5 text-sm font-mono text-slate-700 dark:text-slate-200 outline-none transition-all">
                </div>
            </div>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                💡 Tip: Klik kanan di Google Maps → "What's here?" untuk mendapatkan koordinat.
            </p>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal()" class="flex-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold py-3.5 rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-600 transition text-sm">Batal</button>
                <button type="submit" class="flex-[2] bg-emerald-600 hover:bg-emerald-500 text-white font-black py-3.5 rounded-2xl shadow-lg shadow-emerald-500/20 transition-all hover:scale-[1.02] text-sm">💾 Simpan Lokasi</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map;
    document.addEventListener('DOMContentLoaded', function() {
        var locations = @json($locations);
        var defaultLat = locations.length > 0 ? parseFloat(locations[0].lat) : -6.9;
        var defaultLng = locations.length > 0 ? parseFloat(locations[0].lng) : 107.6;

        map = L.map('map', { zoomControl: true }).setView([defaultLat, defaultLng], locations.length > 0 ? 17 : 13);

        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20, subdomains: ['mt0','mt1','mt2','mt3'], attribution: '© Google Maps'
        }).addTo(map);

        locations.forEach(function(loc) {
            var colors = { greenhouse: '#10b981', waste: '#ef4444', other: '#3b82f6' };
            var emojis = { greenhouse: '🌱', waste: '♻️', other: '🌿' };
            var color = colors[loc.type] || colors.other;
            var emoji = emojis[loc.type] || emojis.other;

            var icon = L.divIcon({
                className: '',
                html: `<div style="background:${color};width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem;border:3px solid white;box-shadow:0 4px 15px rgba(0,0,0,0.25)">${emoji}</div>`,
                iconSize: [44, 44], iconAnchor: [22, 22]
            });

            L.marker([parseFloat(loc.lat), parseFloat(loc.lng)], { icon })
                .addTo(map)
                .bindPopup(`<div style="padding:12px;min-width:140px;font-family:'Plus Jakarta Sans',sans-serif">
                    <p style="font-weight:900;font-size:14px;margin:0 0 4px">${emoji} ${loc.name}</p>
                    <p style="font-size:11px;color:#64748b;text-transform:uppercase;font-weight:700;margin:0 0 8px">${loc.type}</p>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${loc.lat},${loc.lng}" target="_blank"
                       style="font-size:11px;color:#10b981;font-weight:700;">Buka di Google Maps ↗</a>
                </div>`);
        });
    });

    function zoomTo(lat, lng) {
        if (map) {
            map.flyTo([parseFloat(lat), parseFloat(lng)], 19, { animate: true, duration: 1.5 });
            window.scrollTo({ top: document.getElementById('map').offsetTop - 100, behavior: 'smooth' });
        }
    }

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
</script>
@endsection
