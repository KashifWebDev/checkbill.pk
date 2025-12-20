@extends('layouts.app')

@section('title', 'Internet Bill Online 2025 — PTCL, Nayatel & StormFiber')
@section('meta_description', 'Check internet bills online for PTCL, Nayatel and StormFiber in Pakistan. Learn how to manage all internet invoices in one calm dashboard with CheckBill.pk.')
@section('canonical', config('app.url') . '/internet-bill-online')

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ config('app.url') }}/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Internet Bill Online",
      "item": "{{ config('app.url') }}/internet-bill-online"
    }
  ]
}
</script>
@endpush

@php
    $allProviders = config('providers.providers');
    $internetProviders = collect($allProviders)
        ->filter(fn($p) => $p['type'] === 'internet')
        ->map(function ($provider) {
            return [
                'key' => $provider['key'],
                'label' => $provider['name'],
                'name' => $provider['full_name'],
                'route' => route('providers.' . $provider['key']),
                'tagline' => implode(', ', array_slice($provider['coverage_area'], 0, 2)),
                'logo' => asset($provider['image_path']),
            ];
        })
        ->values()
        ->toArray();
@endphp

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50/80 backdrop-blur-sm px-4 py-1.5 text-xs font-semibold text-blue-700 mb-6 uppercase tracking-wide">
                <iconify-icon icon="lucide:wifi" width="14"></iconify-icon>
                {{ count($internetProviders) }} Internet Providers
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                Internet Bills<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600">Made Simple</span>
            </h1>
            <p class="text-lg sm:text-xl text-slate-600 mb-4 max-w-2xl mx-auto leading-relaxed">
                Check duplicate internet bills from PTCL, Nayatel, and StormFiber. Save your account IDs once, check every month with one click.
            </p>
            <p class="text-sm text-slate-500 mb-8 max-w-xl mx-auto">
                PTCL • Nayatel • StormFiber – all in one place
            </p>
        </div>

        <!-- Quick Check Card -->
        <div class="max-w-2xl mx-auto mb-16 animate-fade-in-up animate-delay-100">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <iconify-icon icon="lucide:wifi" width="20" class="text-blue-500"></iconify-icon>
                    Check Your Internet Bill
                </h2>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-5">
                    <input type="hidden" name="type" value="internet">
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Select Provider</label>
                        <select name="provider" required class="w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl px-4 py-4 text-sm font-semibold text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                            <option value="">Choose your internet provider...</option>
                            @foreach ($internetProviders as $provider)
                                <option value="{{ $provider['key'] }}">{{ $provider['label'] }} - {{ $provider['tagline'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Account ID / Connection Number</label>
                            <button type="button" class="text-[11px] font-medium text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </button>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 group-focus-within:text-blue-500 transition-colors"></iconify-icon>
                            </div>
                            <input type="tel" name="reference_number" placeholder="Enter your internet account ID" required class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                        </div>
                    </div>

                    @guest
                        <div class="flex items-center gap-2 opacity-60">
                            <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 cursor-not-allowed" disabled>
                            <label class="text-xs text-slate-600 select-none">Save this bill for quick access next month</label>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-blue-700 hover:text-blue-800 group">
                            <iconify-icon icon="lucide:arrow-right" width="12" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                            Create free account to save bills & get email reminders
                        </a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="save-bill" name="save_bill" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer accent-blue-600">
                            <label for="save-bill" class="text-xs text-slate-600 select-none cursor-pointer">Save this bill to my dashboard</label>
                        </div>
                    @endauth

                    <button type="submit" class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Check My Internet Bill
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- All Providers Grid -->
        <div class="mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">All Internet Providers</h2>
                <p class="text-slate-600 max-w-xl mx-auto">Choose your provider to check bills or learn more</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 max-w-3xl mx-auto">
                @foreach ($internetProviders as $provider)
                    <a href="{{ $provider['route'] }}" class="group p-6 rounded-2xl bg-white border-2 border-slate-100 hover:border-blue-300 hover:shadow-xl transition-all duration-200">
                        <div class="flex flex-col items-center text-center gap-3">
                            <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center p-3 shadow-sm group-hover:scale-110 transition-transform">
                                <img src="{{ $provider['logo'] }}" alt="{{ $provider['label'] }} logo" class="w-full h-full object-contain" loading="lazy">
                            </div>
                            <div>
                                <p class="text-base font-bold text-slate-900 mb-1">{{ $provider['label'] }}</p>
                                <p class="text-xs text-slate-500 leading-snug mb-2">{{ $provider['name'] }}</p>
                                <p class="text-[10px] text-blue-600 font-semibold">{{ $provider['tagline'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="grid md:grid-cols-2 gap-6 mb-16">
            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:clock" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">One Dashboard for All</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Manage PTCL, Nayatel, and StormFiber bills together with your electricity and gas bills. One place for all your utility payments.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:bell" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Prevent Service Suspension</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Get email reminders before your internet bill due date. Keep your connection active and avoid service interruptions.</p>
            </div>
        </div>

        <!-- CTA Section -->
        @guest
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-12 border-2 border-blue-400/30 shadow-2xl">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to simplify your internet bills?</h2>
                <p class="text-lg text-slate-300 mb-8 max-w-xl mx-auto">
                    Create a free account to save your account IDs and check bills every month with one click
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 rounded-full bg-blue-500 px-8 py-4 text-base font-bold text-white hover:bg-blue-400 transition shadow-xl hover:scale-105">
                    <iconify-icon icon="lucide:user-plus" width="20"></iconify-icon>
                    Create Your Free Account
                </a>
            </div>
        </div>
        @endguest
    </div>
@endsection
