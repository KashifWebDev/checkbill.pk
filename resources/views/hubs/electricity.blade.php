@extends('layouts.app')

@section('title', 'Electricity Bill Online 2025 in Pakistan — Check & Save with CheckBill.pk')
@section('meta_description', 'Check electricity bills online in Pakistan for IESCO, LESCO, MEPCO, FESCO, PESCO, GEPCO, HESCO, SEPCO, QESCO, TESCO and K-Electric. Learn how to save meters and get reminders with CheckBill.pk.')
@section('canonical', config('app.url') . '/electricity-bill-online')

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
      "name": "Electricity Bill Online",
      "item": "{{ config('app.url') }}/electricity-bill-online"
    }
  ]
}
</script>
@endpush

@php
    $allProviders = config('providers.providers');
    $electricityProviders = collect($allProviders)
        ->filter(fn($p) => $p['type'] === 'electricity')
        ->map(function ($provider) {
            return [
                'key' => $provider['key'],
                'label' => $provider['name'],
                'name' => $provider['full_name'],
                'route' => route('providers.' . ($provider['key'] === 'ke' ? 'kelectric' : $provider['key'])),
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
            <div class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50/80 backdrop-blur-sm px-4 py-1.5 text-xs font-semibold text-orange-700 mb-6 uppercase tracking-wide">
                <iconify-icon icon="lucide:zap" width="14"></iconify-icon>
                {{ count($electricityProviders) }} Electricity Providers
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                Electricity Bills<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 via-amber-600 to-yellow-600">Made Simple</span>
            </h1>
            <p class="text-lg sm:text-xl text-slate-600 mb-4 max-w-2xl mx-auto leading-relaxed">
                Check duplicate electricity bills from all major providers across Pakistan. Save your reference numbers once, check every month with one click.
            </p>
            <p class="text-sm text-slate-500 mb-8 max-w-xl mx-auto">
                IESCO, LESCO, K-Electric, MEPCO, FESCO, PESCO, GEPCO, HESCO, SEPCO, QESCO, TESCO – all in one place
            </p>
        </div>

        <!-- Quick Check Card -->
        <div class="max-w-2xl mx-auto mb-16 animate-fade-in-up animate-delay-100">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <iconify-icon icon="lucide:search" width="20" class="text-orange-500"></iconify-icon>
                    Check Your Electricity Bill
                </h2>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-5">
                    <input type="hidden" name="type" value="electricity">
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Select Provider</label>
                        <select name="provider" required class="w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl px-4 py-4 text-sm font-semibold text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all">
                            <option value="">Choose your electricity company...</option>
                            @foreach ($electricityProviders as $provider)
                                <option value="{{ $provider['key'] }}">{{ $provider['label'] }} - {{ $provider['tagline'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference Number</label>
                            <button type="button" class="text-[11px] font-medium text-orange-600 hover:text-orange-700 hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </button>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 group-focus-within:text-orange-500 transition-colors"></iconify-icon>
                            </div>
                            <input type="tel" name="reference_number" placeholder="Enter your 14-digit reference number" required class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all">
                        </div>
                    </div>

                    @guest
                        <div class="flex items-center gap-2 opacity-60">
                            <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-orange-600 cursor-not-allowed" disabled>
                            <label class="text-xs text-slate-600 select-none">Save this bill for quick access next month</label>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-orange-700 hover:text-orange-800 group">
                            <iconify-icon icon="lucide:arrow-right" width="12" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                            Create free account to save bills & get email reminders
                        </a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="save-bill" name="save_bill" class="w-4 h-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500 cursor-pointer accent-orange-600">
                            <label for="save-bill" class="text-xs text-slate-600 select-none cursor-pointer">Save this bill to my dashboard</label>
                        </div>
                    @endauth

                    <button type="submit" class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-orange-600 to-amber-600 py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Check My Electricity Bill
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- All Providers Grid -->
        <div class="mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">All Electricity Providers</h2>
                <p class="text-slate-600 max-w-xl mx-auto">Choose your provider to check bills or learn more about each company</p>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($electricityProviders as $provider)
                    <a href="{{ $provider['route'] }}" class="group p-5 rounded-2xl bg-white border-2 border-slate-100 hover:border-orange-300 hover:shadow-xl transition-all duration-200">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center p-3 shadow-sm group-hover:scale-110 transition-transform">
                                <img src="{{ $provider['logo'] }}" alt="{{ $provider['label'] }} logo" class="w-full h-full object-contain" loading="lazy">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $provider['label'] }}</p>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-snug line-clamp-2">{{ $provider['name'] }}</p>
                                <p class="text-[10px] text-orange-600 font-semibold mt-1">{{ $provider['tagline'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="grid md:grid-cols-2 gap-6 mb-16">
            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:clock" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Save Time Every Month</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Instead of searching "IESCO bill online" or "LESCO bill check" every month, save your reference number once and check with one click.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:bell" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Never Miss a Due Date</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Get email reminders before your electricity bill due date. Avoid late payment surcharges and keep your connection active.</p>
            </div>
        </div>

        <!-- CTA Section -->
        @guest
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-12 border-2 border-orange-400/30 shadow-2xl">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to simplify your electricity bills?</h2>
                <p class="text-lg text-slate-300 mb-8 max-w-xl mx-auto">
                    Create a free account to save all your meters and check bills every month with one click
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 rounded-full bg-orange-500 px-8 py-4 text-base font-bold text-white hover:bg-orange-400 transition shadow-xl hover:scale-105">
                    <iconify-icon icon="lucide:user-plus" width="20"></iconify-icon>
                    Create Your Free Account
                </a>
            </div>
        </div>
        @endguest
    </div>
@endsection
