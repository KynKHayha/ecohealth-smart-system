@extends('layouts.app')
@section('title', 'Hubungi Kami | EcoHealth Mekarjaya')

@section('content')
<div class="pt-20 min-h-screen bg-slate-50 dark:bg-slate-950 flex items-center py-12 px-4 sm:px-6">
    <div class="max-w-5xl w-full mx-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-2xl shadow-slate-900/10 dark:shadow-black/30 border border-slate-100 dark:border-slate-700 flex flex-col lg:flex-row" data-aos="fade-up">

            {{-- Left Panel --}}
            <div class="lg:w-2/5 bg-emerald-950 dark:bg-slate-900 p-10 sm:p-12 text-white flex flex-col justify-between">
                <div>
                    <a href="{{ route('index') }}" class="inline-flex items-center gap-2 text-emerald-400 hover:text-white font-bold text-sm mb-10 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Home
                    </a>
                    <div class="text-5xl mb-5">💬</div>
                    <h1 class="text-4xl sm:text-5xl font-black mb-5 leading-tight tracking-tight">Mari Bicara<br>dengan Kami</h1>
                    <p class="text-emerald-100/60 text-base leading-relaxed">Kami senang mendengar saran, masukan, atau pertanyaan mengenai sistem EcoHealth Desa Mekarjaya.</p>
                </div>

                <div class="mt-10 space-y-5 pt-10 border-t border-white/10">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl flex-shrink-0">📍</div>
                        <p class="font-medium text-sm text-white/80">Balai Desa Mekarjaya, Jawa Barat</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl flex-shrink-0">📧</div>
                        <p class="font-medium text-sm text-white/80">mekarj2026@gmail.com</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl flex-shrink-0">💬</div>
                        <a href="https://wa.me/6281281954124" target="_blank" class="font-medium text-sm text-emerald-400 hover:text-emerald-300 transition">+62 812-8195-4124 (WhatsApp)</a>
                    </div>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="lg:w-3/5 p-10 sm:p-12">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 tracking-tight">Kirim Pesan 🚀</h2>

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 rounded-2xl text-sm font-medium">
                    <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all placeholder:text-slate-400">
                        </div>
                        <div>
                            <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Email Aktif</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@anda.com"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all placeholder:text-slate-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Subjek</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="Apa yang ingin dibahas?"
                            class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all placeholder:text-slate-400">
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Pesan</label>
                        <textarea name="message" rows="5" required placeholder="Tulis pesan Anda..."
                            class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-700 border border-transparent focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 rounded-2xl text-sm font-medium text-slate-700 dark:text-slate-200 outline-none transition-all placeholder:text-slate-400 resize-none">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-base hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-emerald-500/20">
                        Kirim Pesan Sekarang ✉️
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection