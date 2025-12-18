@extends('layouts.app')

@section('title', 'IESCO Bill Online — Check and Download Duplicate Electricity Bill')
@section('meta_description', 'Check IESCO bill online by reference number, download duplicate IESCO electricity bill, learn where to find the reference number and how to pay on time with CheckBill.pk.')
@section('canonical', url('/iesco-bill-online'))
@section('jsonld')
@verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How can I check my IESCO bill online?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "To check your IESCO bill online, select IESCO as the provider on CheckBill.pk, enter your 14 digit reference number from the top right of your bill and click Check duplicate bill."
          }
        },
        {
          "@type": "Question",
          "name": "Where can I find my IESCO reference number?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Your IESCO reference number is printed in the top section of your physical bill, usually labelled as Reference No or Consumer No. It is a 14 digit number often grouped with dashes."
          }
        },
        {
          "@type": "Question",
          "name": "Can I pay my IESCO bill online?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. You can pay your IESCO bill through internet banking, mobile wallets like Easypaisa and JazzCash or through your bank's mobile app by entering the reference number."
          }
        },
        {
          "@type": "Question",
          "name": "What happens if I pay my IESCO bill after the due date?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "If you pay your IESCO bill after the due date, a late payment surcharge is added and the amount payable increases. CheckBill.pk helps you see due dates early so you can avoid this fee."
          }
        },
        {
          "@type": "Question",
          "name": "Is CheckBill.pk an official IESCO website?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CheckBill.pk is not an official IESCO website. It is a companion tool that helps you manage IESCO and other Pakistani utility bills from one dashboard using official data sources."
          }
        }
      ]
    }
    </script>
@endverbatim
@endsection

@php
    $providerLogos = [
        'iesco' => asset('storage/img/iesco.jpg'),
    ];
    
    $provider = [
        'key' => 'iesco',
        'label' => 'IESCO',
        'name' => 'Islamabad Electric Supply Company',
        'type' => 'electricity',
        'tagline' => 'Islamabad region',
        'logo' => $providerLogos['iesco'],
    ];
    
    $typeLabel = 'Electricity';
    $isElectricity = true;
    
    $badgeClasses = 'border-orange-200 bg-orange-50/80 text-orange-700';
    $iconColor = 'text-orange-500';
    $textColor = 'text-orange-600 hover:text-orange-700';
    $focusRing = 'focus:ring-orange-500/30 focus:border-orange-500';
    $buttonGradient = 'from-orange-600 to-amber-600';
    $gradientText = 'from-orange-600 via-amber-600 to-yellow-600';
    $stepBg = 'from-orange-500 to-amber-600';
    $ctaBorder = 'border-orange-400/30';
    $ctaButton = 'bg-orange-500 hover:bg-orange-400';
    $checkboxColor = 'text-orange-600 focus:ring-orange-500 accent-orange-600';
@endphp

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
                <iconify-icon icon="lucide:zap" width="14"></iconify-icon>
                Electricity Provider
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                {{ $provider['label'] }}<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $gradientText }}">electricity bill online</span>
            </h1>
            <p class="text-lg sm:text-xl text-slate-600 mb-4 max-w-2xl mx-auto leading-relaxed">
                Check your {{ $provider['name'] }} electricity bill online instantly. Save your reference number once, check every month with one click.
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
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference Number</label>
                            <button type="button" class="text-[11px] font-medium {{ $textColor }} hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </button>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 group-focus-within:text-orange-500 transition-colors"></iconify-icon>
                            </div>
                            <input type="text" name="reference_number" placeholder="Enter the number printed on your bill" required
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 {{ $focusRing }} transition-all">
                        </div>
                        <p class="mt-2 text-xs text-slate-500 flex items-center gap-1">
                            <iconify-icon icon="lucide:info" width="12"></iconify-icon>
                            Typically found near the top of your {{ $provider['name'] }} bill, labelled as Reference No, Consumer No or Account ID.
                        </p>
                    </div>

                    @auth
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="save-bill" name="save_bill" class="w-4 h-4 rounded border-slate-300 {{ $checkboxColor }} cursor-pointer">
                            <label for="save-bill" class="text-xs text-slate-600 select-none cursor-pointer">Save this bill to my dashboard</label>
                        </div>
                    @else
                        <div class="flex items-center gap-2 opacity-60">
                            <input type="checkbox" class="w-4 h-4 rounded border-slate-300 {{ $checkboxColor }} cursor-not-allowed" disabled>
                            <label class="text-xs text-slate-600 select-none">Save this bill for quick access next month</label>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-xs font-semibold {{ $textColor }} group">
                            <iconify-icon icon="lucide:arrow-right" width="12" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                            Create free account to save bills & get email reminders
                        </a>
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
