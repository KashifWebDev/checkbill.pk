@extends('layouts.app')

@php
    // Provider logos mapping
    $providerLogos = [
        'iesco' => asset('storage/img/iesco.jpg'),
        'lesco' => asset('storage/img/lesco.png'),
        'mepco' => asset('storage/img/mepco.png'),
        'fesco' => asset('storage/img/fesco.png'),
        'pesco' => asset('storage/img/pesco.png'),
        'gepco' => asset('storage/img/gepco.png'),
        'hesco' => asset('storage/img/hesco.jpg'),
        'sepco' => asset('storage/img/sepco.png'),
        'qesco' => asset('storage/img/qesco.png'),
        'tesco' => asset('storage/img/tesco.png'),
        'ke' => asset('storage/img/kelectric.jpg'),
        'sngpl' => asset('storage/img/sngpl.png'),
        'ssgc' => asset('storage/img/ssgc.png'),
        'ptcl' => asset('storage/img/ptcl.jpg'),
        'nayatel' => asset('storage/img/nayatel.jpg'),
        'stormfiber' => asset('storage/img/stormfiber.png'),
    ];

    // Provider full names and taglines
    $providerDetails = [
        'iesco' => ['label' => 'IESCO', 'fullName' => 'Islamabad Electric Supply Company', 'tagline' => 'Islamabad region'],
        'lesco' => ['label' => 'LESCO', 'fullName' => 'Lahore Electric Supply Company', 'tagline' => 'Lahore region'],
        'mepco' => ['label' => 'MEPCO', 'fullName' => 'Multan Electric Power Company', 'tagline' => 'Multan region'],
        'fesco' => ['label' => 'FESCO', 'fullName' => 'Faisalabad Electric Supply Company', 'tagline' => 'Faisalabad region'],
        'pesco' => ['label' => 'PESCO', 'fullName' => 'Peshawar Electric Supply Company', 'tagline' => 'Peshawar region'],
        'gepco' => ['label' => 'GEPCO', 'fullName' => 'Gujranwala Electric Power Company', 'tagline' => 'Gujranwala region'],
        'hesco' => ['label' => 'HESCO', 'fullName' => 'Hyderabad Electric Supply Company', 'tagline' => 'Hyderabad region'],
        'sepco' => ['label' => 'SEPCO', 'fullName' => 'Sukkur Electric Power Company', 'tagline' => 'Sukkur region'],
        'qesco' => ['label' => 'QESCO', 'fullName' => 'Quetta Electric Supply Company', 'tagline' => 'Quetta region'],
        'tesco' => ['label' => 'TESCO', 'fullName' => 'Tribal Electric Supply Company', 'tagline' => 'Tribal Areas'],
        'ke' => ['label' => 'K-Electric', 'fullName' => 'Karachi Electric', 'tagline' => 'Karachi city'],
        'sngpl' => ['label' => 'SNGPL', 'fullName' => 'Sui Northern Gas Pipelines Ltd.', 'tagline' => 'Punjab & KPK'],
        'ssgc' => ['label' => 'SSGC', 'fullName' => 'Sui Southern Gas Company', 'tagline' => 'Sindh & Balochistan'],
        'ptcl' => ['label' => 'PTCL', 'fullName' => 'Pakistan Telecommunication Company Limited', 'tagline' => 'Nationwide internet'],
        'nayatel' => ['label' => 'Nayatel', 'fullName' => 'Nayatel Fiber Internet', 'tagline' => 'Fiber cities'],
        'stormfiber' => ['label' => 'StormFiber', 'fullName' => 'StormFiber Broadband', 'tagline' => 'Fiber broadband'],
    ];

    // Enhance provider array with missing fields
    $providerKey = $provider['key'];
    $provider['label'] = $providerDetails[$providerKey]['label'] ?? $provider['name'];
    $provider['name'] = $providerDetails[$providerKey]['fullName'] ?? $provider['name'];
    $provider['tagline'] = $providerDetails[$providerKey]['tagline'] ?? '';
    $provider['logo'] = $providerLogos[$providerKey] ?? asset('storage/img/' . $providerKey . '.png');

    $typeLabel = [
        'electricity' => 'Electricity',
        'gas' => 'Gas',
        'internet' => 'Internet',
    ][$provider['type']] ?? 'Utility';

    $pageTitle = $provider['name'].' '.$typeLabel.' Bill Online — Check Duplicate Bill';
    
    // Color classes based on provider type
    $isElectricity = $provider['type'] === 'electricity';
    $isGas = $provider['type'] === 'gas';
    $isInternet = $provider['type'] === 'internet';
    
    $badgeClasses = $isElectricity ? 'border-orange-200 bg-orange-50/80 text-orange-700' : ($isGas ? 'border-red-200 bg-red-50/80 text-red-700' : 'border-blue-200 bg-blue-50/80 text-blue-700');
    $iconColor = $isElectricity ? 'text-orange-500' : ($isGas ? 'text-red-500' : 'text-blue-500');
    $textColor = $isElectricity ? 'text-orange-600 hover:text-orange-700' : ($isGas ? 'text-red-600 hover:text-red-700' : 'text-blue-600 hover:text-blue-700');
    $focusRing = $isElectricity ? 'focus:ring-orange-500/30 focus:border-orange-500' : ($isGas ? 'focus:ring-red-500/30 focus:border-red-500' : 'focus:ring-blue-500/30 focus:border-blue-500');
    $buttonGradient = $isElectricity ? 'from-orange-600 to-amber-600' : ($isGas ? 'from-red-600 to-rose-600' : 'from-blue-600 to-indigo-600');
    $gradientText = $isElectricity ? 'from-orange-600 via-amber-600 to-yellow-600' : ($isGas ? 'from-red-600 via-rose-600 to-pink-600' : 'from-blue-600 via-indigo-600 to-purple-600');
    $iconClasses = $isElectricity ? 'text-orange-500' : ($isGas ? 'text-red-500' : 'text-blue-500');
    $stepBg = $isElectricity ? 'from-orange-500 to-amber-600' : ($isGas ? 'from-red-500 to-rose-600' : 'from-blue-500 to-indigo-600');
    $ctaBorder = $isElectricity ? 'border-orange-400/30' : ($isGas ? 'border-red-400/30' : 'border-blue-400/30');
    $ctaButton = $isElectricity ? 'bg-orange-500 hover:bg-orange-400' : ($isGas ? 'bg-red-500 hover:bg-red-400' : 'bg-blue-500 hover:bg-blue-400');
    $checkboxColor = $isElectricity ? 'text-orange-600 focus:ring-orange-500 accent-orange-600' : ($isGas ? 'text-red-600 focus:ring-red-500 accent-red-600' : 'text-blue-600 focus:ring-blue-500 accent-blue-600');
@endphp

@section('title', $pageTitle)
@section('meta_description', 'Check your '.$provider['name'].' '.$typeLabel.' bill online by reference or consumer number with CheckBill.pk. Save this meter for one-click checking next month.')
@section('canonical', url('/'.$slug))

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-20 h-20 rounded-2xl bg-white border-2 border-slate-200 flex items-center justify-center p-4 shadow-lg">
                    <img src="{{ $provider['logo'] }}" alt="{{ $provider['label'] }} logo" class="w-full h-full object-contain" loading="lazy">
                </div>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border {{ $badgeClasses }} backdrop-blur-sm px-4 py-1.5 text-xs font-semibold mb-6 uppercase tracking-wide">
                <iconify-icon icon="lucide:{{ $provider['type'] === 'electricity' ? 'zap' : ($provider['type'] === 'gas' ? 'flame' : 'wifi') }}" width="14"></iconify-icon>
                {{ ucfirst($provider['type']) }} Provider
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                {{ $provider['label'] }}<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $gradientText }}">{{ strtolower($typeLabel) }} bill online</span>
            </h1>
            <p class="text-lg sm:text-xl text-slate-600 mb-4 max-w-2xl mx-auto leading-relaxed">
                Check your {{ $provider['name'] }} {{ strtolower($typeLabel) }} bill online instantly. Save your reference number once, check every month with one click.
            </p>
            <p class="text-sm text-slate-500 mb-8 max-w-xl mx-auto">
                {{ $provider['tagline'] }}
            </p>
        </div>

        <!-- Quick Check Card -->
        <div class="max-w-2xl mx-auto mb-16 animate-fade-in-up animate-delay-100">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <iconify-icon icon="lucide:search" width="20" class="{{ $iconColor }}"></iconify-icon>
                    Check Your {{ $provider['label'] }} Bill
                </h2>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-5">
                    <input type="hidden" name="type" value="{{ $provider['type'] }}">
                    <input type="hidden" name="provider" value="{{ $provider['key'] }}">

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference / Consumer Number</label>
                            <button type="button" class="text-[11px] font-medium {{ $textColor }} hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </button>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 {{ $isElectricity ? 'group-focus-within:text-orange-500' : ($isGas ? 'group-focus-within:text-red-500' : 'group-focus-within:text-blue-500') }} transition-colors"></iconify-icon>
                            </div>
                            <input type="text" name="reference_number" placeholder="Enter the number printed on your bill" required
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 {{ $focusRing }} transition-all">
                        </div>
                        <p class="mt-2 text-xs text-slate-500 flex items-center gap-1">
                            <iconify-icon icon="lucide:info" width="12"></iconify-icon>
                            Typically found near the top of your {{ $provider['name'] }} bill, labelled as Reference No, Consumer No or Account ID.
                        </p>
                    </div>

                    @guest
                        <div class="flex items-center gap-2 opacity-60">
                            <input type="checkbox" class="w-4 h-4 rounded border-slate-300 {{ $checkboxColor }} cursor-not-allowed" disabled>
                            <label class="text-xs text-slate-600 select-none">Save this bill for quick access next month</label>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-xs font-semibold {{ $textColor }} group">
                            <iconify-icon icon="lucide:arrow-right" width="12" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                            Create free account to save bills & get email reminders
                        </a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="save-bill" name="save_bill" class="w-4 h-4 rounded border-slate-300 {{ $checkboxColor }} cursor-pointer">
                            <label for="save-bill" class="text-xs text-slate-600 select-none cursor-pointer">Save this bill to my dashboard</label>
                        </div>
                    @endauth

                    <button type="submit" class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r {{ $buttonGradient }} py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Check My {{ $provider['label'] }} Bill
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="grid md:grid-cols-3 gap-6 mb-16">
            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $stepBg }} text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:clock" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Instant Bill Check</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Enter your reference number and get your {{ $provider['label'] }} bill details instantly. No waiting, no delays.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:save" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Save for Next Month</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Save this {{ $provider['label'] }} meter once. Next month, check your bill with one click from your dashboard.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border-2 border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center mb-4 shadow-lg">
                    <iconify-icon icon="lucide:bell" width="24"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Email Reminders</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Get notified before your {{ $provider['label'] }} bill due date. Never pay late fees again.</p>
            </div>
        </div>

        <!-- How It Works -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">How to check your {{ $provider['label'] }} bill</h2>
                <p class="text-slate-600">Three simple steps to get your duplicate bill</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 border-2 border-slate-100 text-center">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $stepBg }} text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg mx-auto">1</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Find Your Reference Number</h3>
                    <p class="text-sm text-slate-600">Look for the reference or consumer number on your {{ $provider['label'] }} bill, usually near the top.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 border-2 border-slate-100 text-center">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $stepBg }} text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg mx-auto">2</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Enter & Check</h3>
                    <p class="text-sm text-slate-600">Type the number in the form above and click "Check My {{ $provider['label'] }} Bill" to see your duplicate bill.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 border-2 border-slate-100 text-center">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $stepBg }} text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg mx-auto">3</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Save for Next Time</h3>
                    <p class="text-sm text-slate-600">Create a free account to save this meter. Next month, check with one click from your dashboard.</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        @guest
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-12 border-2 {{ $ctaBorder }} shadow-2xl">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Save this {{ $provider['label'] }} meter for next month</h2>
                <p class="text-lg text-slate-300 mb-8 max-w-xl mx-auto">
                    Create a free account to save your reference number and check bills every month with one click
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 rounded-full {{ $ctaButton }} px-8 py-4 text-base font-bold text-white transition shadow-xl hover:scale-105">
                    <iconify-icon icon="lucide:user-plus" width="20"></iconify-icon>
                    Create Your Free Account
                </a>
            </div>
        </div>
        @endguest
    </div>
@endsection
