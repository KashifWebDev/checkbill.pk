@extends('layouts.app')

@section('title', 'SNGPL Bill Online — Check and Download Duplicate Gas Bill')
@section('meta_description', 'Check SNGPL bill online by consumer number, download duplicate SNGPL gas bill, and learn how to avoid late payment surcharge with reminders from CheckBill.pk.')
@section('canonical', url('/sngpl-bill-online'))
@section('jsonld')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How can I check my SNGPL bill online?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "To check your SNGPL bill online, select SNGPL on CheckBill.pk, enter your consumer number from the top area of your gas bill and click Check duplicate bill."
          }
        },
        {
          "@type": "Question",
          "name": "Where do I find my SNGPL consumer number?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Your SNGPL consumer number is printed near the top of your physical gas bill. It is usually labelled as Consumer No or Consumer ID and is the same number used for online payments."
          }
        },
        {
          "@type": "Question",
          "name": "Can I download a duplicate SNGPL bill?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. SNGPL allows duplicate bills to be viewed and downloaded online. CheckBill.pk will provide a direct link to a clean PDF once live integration is enabled."
          }
        },
        {
          "@type": "Question",
          "name": "What if I lose my gas bill before paying?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "If you lose your SNGPL gas bill, you can still pay by checking a duplicate bill online using your consumer number. CheckBill.pk helps you keep this number safe in your account."
          }
        },
        {
          "@type": "Question",
          "name": "Is CheckBill.pk an official SNGPL website?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No, CheckBill.pk is not an official SNGPL website. It is an independent tool that helps you manage SNGPL and other utility bills from one central dashboard."
          }
        }
      ]
    }
    </script>
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="max-w-3xl mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                SNGPL Bill Online — Check and Download Duplicate Gas Bill
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-3">
                This guide helps you check Sui Northern Gas Pipelines Limited (SNGPL) bills online, understand your consumer
                number and turn CheckBill.pk into a monthly reminder so late fees become rare.
            </p>
            <p class="text-xs text-slate-500">
                The next time you type “SNGPL bill online” in Google, consider opening CheckBill.pk directly instead.
            </p>
        </div>

        <div class="grid md:grid-cols-[2fr,3fr] gap-8 items-start">
            <div class="space-y-4">
                <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold text-slate-900 mb-3">Check your SNGPL gas bill</h2>
                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="type" value="gas">
                        <input type="hidden" name="provider" value="sngpl">

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="sngpl_consumer">
                                SNGPL consumer number
                            </label>
                            <input type="text" id="sngpl_consumer" name="reference_number"
                                   placeholder="Enter your consumer number"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                            <p class="mt-1 text-[10px] text-slate-500">
                                This number is printed near the top of your SNGPL bill and is used for online payments.
                            </p>
                        </div>

                        <button type="submit"
                                class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                            Check duplicate SNGPL bill
                        </button>
                    </form>

                    @guest
                        <p class="mt-3 text-[11px] text-slate-500">
                            You can check a gas bill once and leave. But if you create a free account, CheckBill.pk will remember
                            this consumer number so you never have to hunt for an old bill again.
                        </p>
                    @else
                        <p class="mt-3 text-[11px] text-slate-500">
                            When checking while signed in, you can save this SNGPL meter in your dashboard to see it every month.
                        </p>
                    @endguest
                </div>

                <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2">
                    <p class="text-xs font-semibold text-emerald-300">Why SNGPL users love having an account</p>
                    <ul class="text-[11px] space-y-1.5">
                        <li>Save gas consumer numbers for home, office, shop and parents.</li>
                        <li>Glance at upcoming due dates in a single dashboard.</li>
                        <li>See basic usage history so high winter bills are not a surprise.</li>
                        <li>Receive gentle email nudges before the due date.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8 text-[13px] leading-relaxed text-slate-700">
                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">How to check SNGPL bill online</h2>
                    <p class="mb-2">
                        SNGPL’s online billing system identifies your connection through the consumer number. You do not need to
                        remember the invoice number for every month – the consumer number stays the same.
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-600 mb-2">
                        <li>Take your latest SNGPL gas bill.</li>
                        <li>Find the field labelled “Consumer No” or “Consumer ID”.</li>
                        <li>On this page, enter that number in the box above.</li>
                        <li>Click “Check duplicate SNGPL bill”.</li>
                    </ol>
                    <p>
                        CheckBill.pk will show a placeholder summary for now and later connect to live data so you can see amount
                        and due date without leaving this page.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Where is the SNGPL consumer number printed?</h2>
                    <p class="mb-2">
                        On most SNGPL bills the consumer number is near the top left or top middle part of the first page. It is
                        usually a numeric string separated by spaces or dashes. This is the same number you enter in bank apps when
                        paying a gas bill online.
                    </p>
                    <p>
                        Once you save this number in your CheckBill.pk account, you will not need to keep old paper bills purely
                        for this information.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Downloading a duplicate SNGPL bill</h2>
                    <p class="mb-2">
                        Many users still like to keep a PDF copy of each gas bill. SNGPL supports duplicate bill downloads from
                        its own system. CheckBill.pk will add a direct “Download PDF” option alongside your bill summary once
                        connected, so that you do not have to jump between multiple websites.
                    </p>
                    <p>
                        Even without a PDF, you can pay easily using mobile banking apps where only the consumer number is required.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Avoiding late payment surcharge on SNGPL bills</h2>
                    <p class="mb-2">
                        Gas bills are often smaller than electricity, so they are easy to forget. However, SNGPL still charges
                        a late payment surcharge if you miss the due date. The goal of CheckBill.pk is to keep all of your gas,
                        electricity and internet bills visible in one calm place so that you naturally pay them in time.
                    </p>
                    <p>
                        By saving the gas meter in your dashboard and enabling email reminders, you lower the chances of a bill
                        being hidden under a stack of papers or stuck on a noticeboard.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Roman Urdu: SNGPL bill online kaise check karein</h2>
                    <p class="text-[12px] text-slate-600">
                        Agar aap ka gas SNGPL se aata hai to har mahine “SNGPL bill online” search karna usual baat hai. Is ko
                        simple banane ke liye CheckBill.pk banaya gaya hai. Aap sirf consumer number yaad rakhein, baqi sab hum
                        yaad rakhenge.
                        <br><br>
                        Aaj koi recent bill utha ke consumer number dekh lein. Yahan upar field mein wo number likhein aur button
                        dabayen. Jab aap account bana lete hain to ye number aap ke liye save ho jata hai. Agle mahine jab gas bill
                        ka khayal aaye, bas CheckBill.pk open karein, “Gas – SNGPL” meter select karein aur foran dekh lein ke kitna
                        bill bana hai aur due date kya hai. Late fee se bachne ka asaan tareeqa yahi hai.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">SNGPL specific FAQs</h2>
                    <div class="space-y-3 text-[12px] text-slate-700">
                        <div>
                            <p class="font-semibold text-slate-900">1. Can I check old SNGPL bills?</p>
                            <p>
                                The official portal usually shows the latest gas bill. CheckBill.pk will gradually build your own
                                month‑by‑month history each time you check, which is visible only to you.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">2. Do I need to register with SNGPL to use this?</p>
                            <p>
                                No. You can use CheckBill.pk without any SNGPL login. We only need the consumer number found on
                                your bill.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">3. What if I move house?</p>
                            <p>
                                You can delete an old meter from your dashboard and add the new SNGPL connection. This keeps your
                                view clean and focused on active bills.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">4. Does CheckBill.pk store my full bill details?</p>
                            <p>
                                We primarily store the consumer number, provider name and basic metadata like last checked date.
                                The detailed bill information continues to come from official sources.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">5. Is my email safe with CheckBill.pk?</p>
                            <p>
                                Yes. Your email is used to send reminders and account security notifications only. We do not sell
                                or share it with advertisers.
                            </p>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Explore other utilities</h2>
                    <p class="text-[12px] text-slate-600">
                        If you also handle electricity for the same property, start with the
                        <a href="{{ route('hubs.electricity') }}" class="text-green-700 hover:text-green-800 font-medium">electricity bill online hub</a>
                        or jump directly to the
                        <a href="{{ route('providers.iesco') }}" class="text-green-700 hover:text-green-800 font-medium">IESCO bill online guide</a>.
                        Managing all utilities from a shared dashboard is when CheckBill.pk truly becomes your bill companion.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection


