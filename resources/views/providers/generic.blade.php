@extends('layouts.app')

@php
    $typeLabel = [
        'electricity' => 'Electricity',
        'gas' => 'Gas',
        'internet' => 'Internet',
    ][$provider['type']] ?? 'Utility';

    $pageTitle = $provider['name'].' '.$typeLabel.' Bill Online — Check Duplicate Bill';
@endphp

@section('title')
    {{ $pageTitle }}
@endsection

@section('meta_description')
    Check your {{ $provider['name'] }} {{ $typeLabel }} bill online by reference or consumer number with CheckBill.pk. Save this meter for one-click checking next month.
@endsection

@section('canonical', url('/'.$slug))
@section('jsonld')
    @verbatim
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How can I check my PROVIDER_NAME bill online?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Select PROVIDER_NAME on CheckBill.pk, enter the reference or consumer number from your physical bill and click Check duplicate bill."
      }
    }
  ]
}
        </script>
    @endverbatim
@endsection


@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="max-w-3xl mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                {{ $provider['name'] }} {{ strtolower($typeLabel) }} bill online
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-3">
                Use this page to check your {{ $provider['name'] }} {{ strtolower($typeLabel) }} bill online with a calm,
                distraction‑free flow. You only need the reference or consumer number printed on your physical bill.
            </p>
            <p class="text-xs text-slate-500">
                Instead of searching “{{ strtolower($provider['name']) }} bill online” every month, you can bookmark this page
                and let CheckBill.pk remember the details for you.
            </p>
        </div>

        <div class="grid md:grid-cols-[2fr,3fr] gap-8 items-start">
            <div class="space-y-4">
                <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold text-slate-900 mb-3">Quick {{ $provider['name'] }} bill lookup</h2>
                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="type" value="{{ $provider['type'] }}">
                        <input type="hidden" name="provider" value="{{ $provider['key'] }}">

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="generic_reference">
                                Reference / consumer number
                            </label>
                            <input type="text" id="generic_reference" name="reference_number"
                                   placeholder="Enter the number printed on your bill"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                            <p class="mt-1 text-[10px] text-slate-500">
                                Typically found near the top of your {{ $provider['name'] }} bill, labelled as Reference No, Consumer No or Account ID.
                            </p>
                        </div>

                        <button type="submit"
                                class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                            Check duplicate bill
                        </button>
                    </form>

                    @guest
                        <p class="mt-3 text-[11px] text-slate-500">
                            You can check this bill as a guest. To save this {{ $provider['name'] }} meter for one‑click checks next month,
                            <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">create a free CheckBill.pk account</a>.
                        </p>
                    @else
                        <p class="mt-3 text-[11px] text-slate-500">
                            When you check while signed in, you can save this connection into your dashboard for faster access next time.
                        </p>
                    @endguest
                </div>

                <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2">
                    <p class="text-xs font-semibold text-emerald-300">Why save this {{ $provider['name'] }} meter?</p>
                    <ul class="text-[11px] space-y-1.5">
                        <li>Turn this {{ strtolower($typeLabel) }} connection into a one‑click tile on your dashboard.</li>
                        <li>See all your important {{ strtolower($typeLabel) }} bills in one calm place.</li>
                        <li>Let CheckBill.pk remember reference numbers so you do not have to.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8 text-[13px] leading-relaxed text-slate-700">
                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">How this {{ $provider['name'] }} page works</h2>
                    <p class="mb-2">
                        Every provider listed on CheckBill.pk follows the same calm pattern: you arrive at a dedicated page like
                        this one, enter your reference or consumer number once, and then decide whether you want to save it for
                        the future.
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-600 mb-2">
                        <li>Keep any old {{ $provider['name'] }} bill nearby.</li>
                        <li>Locate the main number printed near the top section.</li>
                        <li>Type it into the box above and tap “Check duplicate bill”.</li>
                        <li>Optionally save it into your dashboard so next month is instant.</li>
                    </ol>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Roman Urdu explanation</h2>
                    <p class="text-[12px] text-slate-600">
                        Har mahine “{{ strtolower($provider['name']) }} bill online” search karne ki bajaye aap CheckBill.pk ko yaad
                        rakh sakte hain. Yahan pe aap sirf bill par likha hua reference ya consumer number daalte hain aur duplicate
                        bill ka summary check kar sakte hain.
                        <br><br>
                        Agar aap account bana lein to ye number hum aap ki taraf se yaad rakhte hain. Agle mahine aap ko sirf
                        dashboard khol kar “{{ $provider['name'] }}” wala meter select karna hota hai, number dubara likhne ki zaroorat
                        nahi parti. Is tarah electricity, gas ya internet ke bills thori der mein manage ho jate hain aur dimaag halka
                        rehta hai.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection


