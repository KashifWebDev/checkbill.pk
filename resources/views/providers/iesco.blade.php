@extends('layouts.app')

@section('title', 'IESCO Bill Online — Check and Download Duplicate Electricity Bill')
@section('meta_description', 'Check IESCO bill online by reference number, download duplicate IESCO electricity bill, learn where to find the reference number and how to pay on time with CheckBill.pk.')
@section('canonical', url('/iesco-bill-online'))
@section('jsonld')
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
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="max-w-3xl mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                IESCO Bill Online — Check and Download Duplicate Electricity Bill
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-3">
                Use this page to check your Islamabad Electric Supply Company (IESCO) bill online by reference number, and to
                turn CheckBill.pk into your quiet monthly assistant for all IESCO bills.
            </p>
            <p class="text-xs text-slate-500">
                Instead of searching “IESCO bill online” every month, bookmark this page once and just bring your reference number.
            </p>
        </div>

        <div class="grid md:grid-cols-[2fr,3fr] gap-8 items-start">
            <div class="space-y-4">
                <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold text-slate-900 mb-3">Check your IESCO bill online</h2>
                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="type" value="electricity">
                        <input type="hidden" name="provider" value="iesco">

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="iesco_reference">
                                IESCO reference number
                            </label>
                            <input type="text" id="iesco_reference" name="reference_number"
                                   placeholder="14 digit reference number"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                            <p class="mt-1 text-[10px] text-slate-500">
                                You can find this on the top right of your physical bill, usually labelled “Reference No”.
                            </p>
                        </div>

                        <button type="submit"
                                class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                            Check duplicate IESCO bill
                        </button>
                    </form>

                    @guest
                        <p class="mt-3 text-[11px] text-slate-500">
                            You can check an IESCO bill without an account. To save this meter for one-tap checking next month,
                            <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">create a free CheckBill.pk account</a>.
                        </p>
                    @else
                        <p class="mt-3 text-[11px] text-slate-500">
                            When you check this bill while signed in you can choose to save it into
                            <a href="{{ route('dashboard') }}" class="font-semibold text-green-700 hover:text-green-800">your dashboard</a>.
                        </p>
                    @endguest
                </div>

                <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2">
                    <p class="text-xs font-semibold text-emerald-300">What an account unlocks for IESCO users</p>
                    <ul class="text-[11px] space-y-1.5">
                        <li>Save multiple IESCO meters (home, office, parents) once.</li>
                        <li>Check IESCO bill online in one click every month.</li>
                        <li>Build a simple history of amounts and due dates.</li>
                        <li>Get email reminders before the last date to avoid surcharge.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8 text-[13px] leading-relaxed text-slate-700">
                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">How to check IESCO bill online by reference number</h2>
                    <p class="mb-2">
                        The IESCO bill online system is built around a 14 digit reference number. Every time you type this number
                        correctly, the system can fetch your duplicate bill from official records.
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-600 mb-2">
                        <li>Take any recent physical IESCO bill.</li>
                        <li>Locate the 14 digit “Reference No” printed near the top right corner.</li>
                        <li>On this page, enter the number in the field above.</li>
                        <li>Click “Check duplicate IESCO bill”.</li>
                    </ol>
                    <p>
                        On CheckBill.pk you can repeat this flow as many times as you like. Once the live integration is active,
                        you will see bill amount, due date and payable after due date directly here.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Where to find IESCO reference number</h2>
                    <p class="mb-2">
                        IESCO prints the reference number in bold in the top section of the bill. It usually looks like a block of
                        digits separated by dashes, for example <span class="font-mono">12 1234 1234567</span>. This is the only
                        number you need on CheckBill.pk.
                    </p>
                    <p>
                        You do not need the customer name, address or CNIC for duplicate bill checks. Keeping one old bill safe is
                        enough to recover the reference number if you forget it.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">How to download duplicate IESCO bill</h2>
                    <p class="mb-2">
                        Today, most users want a clean PDF they can pay from, send on WhatsApp or print if needed. When live
                        integrations are connected, CheckBill.pk will offer a direct “Download duplicate bill” button on this page.
                    </p>
                    <p>
                        Until then, you can still use the reference number to pay through your bank’s mobile app, Easypaisa or
                        JazzCash. Those apps only require the reference number and company name, not the PDF itself.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Paying IESCO bill online and avoiding late surcharge</h2>
                    <p class="mb-2">
                        Most banks in Pakistan now list IESCO inside their bill payment sections. You simply choose IESCO, type the
                        same reference number and confirm the amount. Mobile wallets and over-the-counter retailers follow the
                        same pattern.
                    </p>
                    <p>
                        If you pay after the due date, a late payment surcharge is added and the “after due date” amount becomes
                        active. CheckBill.pk aims to reduce how often this happens by gently reminding you when the due date is
                        near and by keeping your important meters visible in your dashboard.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Roman Urdu: IESCO bill online kaise check karein</h2>
                    <p class="text-[12px] text-slate-600">
                        Agar aap Islamabad ya Rawalpindi mein rehte hain to aksar “IESCO bill online” search karna parta hai.
                        Asaan tareeqa yeh hai ke CheckBill.pk ko yaad rakhein. Yahan pe aap sirf reference number daalte hain aur
                        har mahine duplicate bill check kar sakte hain.
                        <br><br>
                        Pehle kisi purane bill se 14 digit reference number dekh lein. Is page par upar wali field mein number
                        likhein aur button dabayen. Agle mahine dubara search karne ke bajaye, isi page ko bookmark kar dein.
                        Agar aap account bana lein to aap “Home – IESCO” jaisa naam bhi rakh sakte hain taake number yaad na rakhna
                        pade. Phir bas 1 click mein bill dekh sakte hain aur due date se pehle payment kar sakte hain.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">IESCO specific FAQs</h2>
                    <div class="space-y-3 text-[12px] text-slate-700">
                        <div>
                            <p class="font-semibold text-slate-900">1. Can I check previous months’ IESCO bills?</p>
                            <p>
                                The official IESCO system usually focuses on the latest bill. CheckBill.pk will build a private
                                history for you by remembering each month’s amount and due date when you visit, so you can see a
                                timeline even if the provider only shows the current bill.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">2. Do I need to enter CNIC to see my IESCO bill?</p>
                            <p>
                                No. For duplicate bill checks you only need the reference number. CheckBill.pk never asks for CNIC
                                to show basic bill details.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">3. What if I have more than one IESCO meter?</p>
                            <p>
                                You can save each meter separately with nicknames such as “Home upper portion” or “Shop”. Your
                                dashboard will then show all of them together with next due dates.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">4. Is there any fee for using CheckBill.pk with IESCO?</p>
                            <p>
                                No. Checking IESCO bills, saving meters and receiving reminder emails is free. Standard bank or
                                wallet charges for payment still apply, but we do not add any extra fee.
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">5. Can I still pay at the bank after checking here?</p>
                            <p>
                                Yes. Once you know the amount and due date, you can either pay online or walk into a bank branch
                                with a printed duplicate bill when that feature is available.
                            </p>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Internal links and next steps</h2>
                    <p class="text-[12px] text-slate-600">
                        If you also manage gas or internet for the same home, visit the
                        <a href="{{ route('hubs.gas') }}" class="text-green-700 hover:text-green-800 font-medium">gas bill online hub</a>
                        and the
                        <a href="{{ route('hubs.internet') }}" class="text-green-700 hover:text-green-800 font-medium">internet bill hub</a>.
                        Over time this turns CheckBill.pk into your single starting point for all utilities.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection


