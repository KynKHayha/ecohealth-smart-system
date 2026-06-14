@extends('layouts.app')
@section('title', 'EcoHealth Track | Peta Digital Mekarjaya')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
    body { overflow: hidden; }
    #map { position: fixed; inset: 0; z-index: 0; filter: grayscale(0.15) contrast(1.05); }
    .dark #map { filter: grayscale(0.3) brightness(0.8) contrast(1.1); }

    .glass-panel { background: rgba(255,255,255,0.82); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.5); }
    .dark .glass-panel { background: rgba(15,23,42,0.88); border: 1px solid rgba(255,255,255,0.1); }

    .leaflet-popup-content-wrapper { border-radius: 1.25rem !important; padding: 0 !important; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2) !important; }
    .leaflet-popup-tip { display: none; }

    .loc-card { transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1); }
    .loc-card:hover { transform: scale(1.02); }

    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
</style>
@endsection

@section('content')
{{-- Floating top bar --}}
<div class="fixed top-20 left-4 z-[1000] flex items-center gap-3">
    <a href="{{ route('index') }}" class="glass-panel px-4 py-3 rounded-2xl shadow-xl flex items-center gap-2 hover:scale-105 transition-all group">
        <svg class="w-4 h-4 text-slate-700 dark:text-slate-200 group-hover:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        <span class="font-bold text-slate-800 dark:text-slate-200 text-sm">Beranda</span>
    </a>

    <div class="bg-emerald-900/90 dark:bg-emerald-950 backdrop-blur-md px-5 py-3 rounded-2xl shadow-xl border border-emerald-500/20 flex items-center gap-3">
        <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center animate-pulse text-sm">📍</div>
        <div>
            <span class="block font-black text-white text-sm tracking-tight">EcoHealth Tracker</span>
            <span class="text-[10px] text-emerald-400 font-black uppercase tracking-widest">Real-time Mapping</span>
        </div>
    </div>
</div>

{{-- Sidebar Panel (desktop) --}}
<div class="fixed top-16 right-0 z-[1000] w-80 xl:w-96 h-[calc(100vh-4rem)] hidden lg:flex flex-col p-4">
    <div class="glass-panel rounded-3xl shadow-2xl flex flex-col flex-grow overflow-hidden p-6">
        <div class="mb-6">
            <h3 class="font-black text-slate-900 dark:text-white text-xl tracking-tight">Eksplorasi Wilayah</h3>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium mt-1">Klik lokasi untuk navigasi otomatis ke peta</p>
        </div>

        <div class="flex-grow overflow-y-auto space-y-3 pr-1 custom-scroll">
            @forelse($locations as $loc)
            <div class="loc-card group bg-white/60 dark:bg-slate-800/60 hover:bg-white dark:hover:bg-slate-700 rounded-2xl p-4 border border-transparent hover:border-emerald-200 dark:hover:border-emerald-700 hover:shadow-lg cursor-pointer"
                 onclick="zoomTo('{{ $loc->lat }}', '{{ $loc->lng }}')">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl bg-emerald-50 dark:bg-emerald-900/30 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 flex-shrink-0">
                        @if($loc->type == 'greenhouse') 🌱 @elseif($loc->type == 'waste') ♻️ @else 🌿 @endif
                    </div>
                    <div class="flex-grow min-w-0">
                        <h4 class="font-black text-slate-900 dark:text-white text-sm truncate">{{ $loc->name }}</h4>
                        <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider mt-0.5">{{ $loc->type }}</p>
                    </div>
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $loc->lat }},{{ $loc->lng }}" target="_blank"
                       onclick="event.stopPropagation()"
                       class="w-8 h-8 bg-slate-100 dark:bg-slate-600 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all flex-shrink-0 text-sm"
                       title="Buka di Google Maps">↗️</a>
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-slate-400 dark:text-slate-500">
                <div class="text-4xl mb-3">📍</div>
                <p class="text-sm font-medium">Belum ada data lokasi</p>
            </div>
            @endforelse
        </div>

        <div class="mt-5 pt-5 border-t border-slate-200 dark:border-slate-700">
            <div class="bg-emerald-950 dark:bg-emerald-900/30 dark:border dark:border-emerald-800/50 p-5 rounded-2xl text-white flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-1">Statistik Area</p>
                    <p class="text-3xl font-black">{{ $locations->count() }}</p>
                    <p class="text-xs text-emerald-200/60 font-medium">Titik Aktif Terdaftar</p>
                </div>
                <div class="text-4xl">🗺️</div>
            </div>
        </div>
    </div>
</div>

{{-- Map Container --}}
<div id="map"></div>

{{-- Mobile bottom sheet toggle --}}
<div class="lg:hidden fixed bottom-4 left-1/2 -translate-x-1/2 z-[1000]">
    <button onclick="toggleMobileSheet()" class="glass-panel px-6 py-3 rounded-full shadow-xl flex items-center gap-2 font-bold text-slate-800 dark:text-white text-sm">
        📍 {{ $locations->count() }} Lokasi
        <svg id="sheet-chevron" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
    </button>
</div>

{{-- Mobile bottom sheet --}}
<div id="mobile-sheet" class="lg:hidden fixed bottom-0 left-0 right-0 z-[999] translate-y-full transition-transform duration-400 ease-in-out">
    <div class="glass-panel rounded-t-3xl p-5 max-h-[60vh] overflow-y-auto custom-scroll">
        <div class="w-12 h-1.5 bg-slate-300 dark:bg-slate-600 rounded-full mx-auto mb-5"></div>
        <h3 class="font-black text-slate-900 dark:text-white text-lg mb-4">Daftar Lokasi</h3>
        <div class="space-y-3">
            @foreach($locations as $loc)
            <div class="flex items-center gap-3 p-4 bg-white/60 dark:bg-slate-800/60 rounded-2xl" onclick="zoomTo('{{ $loc->lat }}', '{{ $loc->lng }}'); toggleMobileSheet();">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-xl">
                    @if($loc->type == 'greenhouse') 🌱 @elseif($loc->type == 'waste') ♻️ @else 🌿 @endif
                </div>
                <div>
                    <p class="font-bold text-slate-900 dark:text-white text-sm">{{ $loc->name }}</p>
                    <p class="text-[10px] text-slate-400 uppercase font-bold">{{ $loc->type }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map;
    var mobileSheetOpen = false;

    document.addEventListener('DOMContentLoaded', function() {
        var locations = @json($locations);

        if (locations.length > 0) {
            map = L.map('map', { zoomControl: false }).setView([parseFloat(locations[0].lat), parseFloat(locations[0].lng)], 17);

            L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20, subdomains: ['mt0','mt1','mt2','mt3'], attribution: '© Google Maps'
            }).addTo(map);

            L.control.zoom({ position: 'bottomright' }).addTo(map);

            locations.forEach(function(loc) {
                var color = loc.type=='greenhouse' ? '#10b981' : (loc.type=='waste' ? '#ef4444' : '#3b82f6');
                var emoji = loc.type=='greenhouse' ? '🌱' : (loc.type=='waste' ? '♻️' : '🌿');

                var icon = L.divIcon({
                    className: '',
                    html: `<div style="background:${color}" class="w-12 h-12 rounded-full border-4 border-white shadow-2xl flex items-center justify-center text-xl hover:scale-110 transition-transform cursor-pointer">${emoji}</div>`,
                    iconSize: [48, 48], iconAnchor: [24, 24]
                });

                L.marker([parseFloat(loc.lat), parseFloat(loc.lng)], { icon }).addTo(map)
                    .bindPopup(`<div class="p-4 min-w-[150px]"><p class="font-black text-slate-900 text-base">${emoji} ${loc.name}</p><p class="text-xs text-slate-400 font-bold uppercase mt-1">${loc.type}</p><a href="https://www.google.com/maps/dir/?api=1&destination=${loc.lat},${loc.lng}" target="_blank" class="block mt-3 text-center text-xs font-bold text-emerald-600 hover:text-emerald-700">Buka di Google Maps ↗</a></div>`);
            });

            setTimeout(() => map.invalidateSize(), 300);
        }
    });

    function zoomTo(lat, lng) {
        if (map) map.flyTo([parseFloat(lat), parseFloat(lng)], 19, { animate: true, duration: 1.5 });
    }

    function toggleMobileSheet() {
        const sheet = document.getElementById('mobile-sheet');
        const chevron = document.getElementById('sheet-chevron');
        mobileSheetOpen = !mobileSheetOpen;
        sheet.style.transform = mobileSheetOpen ? 'translateY(0)' : 'translateY(100%)';
        chevron.style.transform = mobileSheetOpen ? 'rotate(180deg)' : '';
    }
</script>
@endsection