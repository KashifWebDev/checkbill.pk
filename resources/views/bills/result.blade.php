@extends('layouts.app')

@section('title', $provider['name'].' duplicate bill result — CheckBill.pk')
@section('meta_description', 'Preview for '.$provider['name'].' duplicate bill lookup on CheckBill.pk. This page is not indexed by search engines.')
@section('canonical', isset($provider['slug']) && $provider['slug'] ? url('/'.$provider['slug']) : url()->previous())
@section('robots', 'noindex,nofollow')

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
    $providerKey = strtolower($providerKey ?? '');
    $provider['logo'] = $providerLogos[$providerKey] ?? asset('storage/img/' . $providerKey . '.png');
    $provider['label'] = $providerDetails[$providerKey]['label'] ?? $provider['name'];
    $provider['name'] = $providerDetails[$providerKey]['fullName'] ?? $provider['name'];
    $provider['tagline'] = $providerDetails[$providerKey]['tagline'] ?? '';

    $isElectricity = $type === 'electricity';
    $isGas = $type === 'gas';
    $isInternet = $type === 'internet';
    
    $badgeColor = $isElectricity ? 'orange' : ($isGas ? 'red' : 'blue');
    $badgeClasses = $isElectricity ? 'bg-orange-50 border-orange-200 text-orange-700' : ($isGas ? 'bg-red-50 border-red-200 text-red-700' : 'bg-blue-50 border-blue-200 text-blue-700');
    $buttonColor = $isElectricity ? 'bg-orange-500 hover:bg-orange-400' : ($isGas ? 'bg-red-500 hover:bg-red-400' : 'bg-blue-500 hover:bg-blue-400');
@endphp

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 rounded-full border {{ $badgeClasses }} px-4 py-1.5 text-xs font-semibold mb-6 uppercase tracking-wide">
                <iconify-icon icon="lucide:{{ $isElectricity ? 'zap' : ($isGas ? 'flame' : 'wifi') }}" width="14"></iconify-icon>
                {{ ucfirst($type) }} Bill Result
            </div>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900 mb-4">
                {{ $provider['name'] }} Bill Details
            </h1>
            <p class="text-lg text-slate-600">
                Your duplicate bill information
            </p>
        </div>

        <!-- Bill Info Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-8 mb-8 animate-fade-in-up animate-delay-100">
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 border-2 border-slate-200 flex items-center justify-center p-3 shadow-sm">
                    <img src="{{ $provider['logo'] }}" alt="{{ $provider['name'] }}" class="w-full h-full object-contain" loading="lazy">
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">{{ $provider['name'] }}</h2>
                    <p class="text-sm text-slate-500">{{ ucfirst($type) }} Provider</p>
                </div>
            </div>

            <dl class="space-y-4">
                <div class="flex items-center justify-between p-4 rounded-xl bg-slate-50">
                    <dt class="text-sm font-semibold text-slate-700">Reference / Consumer Number</dt>
                    <dd class="text-sm font-mono font-bold text-slate-900">{{ $reference }}</dd>
                </div>
            </dl>
        </div>

        <!-- Bill Data Placeholder -->
        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 mb-8 text-white border-2 border-emerald-400/30 shadow-2xl">
            <div class="flex items-center gap-3 mb-4">
                <iconify-icon icon="lucide:info" width="20" class="text-emerald-300"></iconify-icon>
                <p class="text-sm font-semibold text-emerald-300">Bill Data Placeholder</p>
            </div>
            <p class="text-sm text-slate-200 leading-relaxed">
                Live bill amount, due date and "after due date" charges will appear here once integrations with {{ $provider['name'] }} are enabled. For now, use this page to confirm that your reference number is saved correctly and to set up your future dashboard.
            </p>
        </div>

        @auth
            <!-- Save Bill Form -->
            <div class="bg-white rounded-3xl shadow-xl border-2 border-slate-100 p-8 mb-8">
                <h2 class="text-xl font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <iconify-icon icon="lucide:save" width="20" class="text-green-500"></iconify-icon>
                    Save this bill to your dashboard
                </h2>
                <p class="text-sm text-slate-600 mb-6">
                    Saving turns this {{ $provider['name'] }} connection into a tile inside your dashboard. Next month you will only need to click "Check now" instead of typing the reference number again.
                </p>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-5">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="provider" value="{{ $providerKey }}">
                    <input type="hidden" name="reference_number" value="{{ $rawReference }}">
                    <input type="hidden" name="save" value="1">

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2" for="nickname">
                            Give this connection a short name
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:tag" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                            <input type="text" id="nickname" name="nickname"
                                   placeholder="e.g. Home ground floor, Parents house, Office"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 text-white text-sm font-bold py-4 shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                        <span class="flex items-center justify-center gap-2">
                            Save to Dashboard
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>
                </form>
            </div>
        @else
            <!-- Guest CTA -->
            <div class="bg-white rounded-3xl shadow-xl border-2 border-slate-100 p-8 mb-8">
                <h2 class="text-xl font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <iconify-icon icon="lucide:save" width="20" class="text-green-500"></iconify-icon>
                    Save this number for next time
                </h2>
                <p class="text-sm text-slate-600 mb-6">
                    Right now you checked this {{ $provider['name'] }} bill as a guest. Next month you will have to type the reference number again. If you create a free account, CheckBill.pk can remember this number for you and show it inside a calm dashboard.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('register') }}" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-4 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                        <iconify-icon icon="lucide:user-plus" width="16"></iconify-icon>
                        Create free account to save this bill
                    </a>
                    <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl border-2 border-slate-200 px-6 py-4 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                        <iconify-icon icon="lucide:log-in" width="16"></iconify-icon>
                        I already have an account
                    </a>
                </div>
            </div>
        @endauth

        <!-- Back Link -->
        <div class="text-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition group">
                <iconify-icon icon="lucide:arrow-left" width="16" class="group-hover:-translate-x-1 transition-transform"></iconify-icon>
                Back to bill page
            </a>
        </div>
    </div>
@endsection
