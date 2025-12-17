@extends('layouts.app')

@section('title', 'Internet Bill Online — PTCL, Nayatel & StormFiber')
@section('meta_description', 'Check internet bills online for PTCL, Nayatel and StormFiber in Pakistan. Learn how to manage all internet invoices in one calm dashboard with CheckBill.pk.')
@section('canonical', url('/internet-bill-online'))

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="max-w-3xl">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                Internet bill online in Pakistan
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-4">
                Check PTCL, Nayatel and StormFiber internet bills from one place. CheckBill.pk helps you remember account IDs,
                see due dates and stay on top of home and office connectivity bills.
            </p>
            <p class="text-xs text-slate-500 mb-8">
                This hub is for users who often search “PTCL bill online”, “Nayatel bill” or “StormFiber invoice” and want a calmer,
                more organised way to handle them.
            </p>
        </div>

        <div class="grid md:grid-cols-[2fr,3fr] gap-8 items-start">
            <div class="space-y-4">
                <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold text-slate-900 mb-3">Quick internet bill lookup</h2>
                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="type" value="internet">
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="isp">
                            Select provider
                        </label>
                        <select id="isp" name="provider" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                            <option value="ptcl">PTCL</option>
                            <option value="nayatel">Nayatel</option>
                            <option value="stormfiber">StormFiber</option>
                        </select>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="internet_reference">
                                Account ID / connection number
                            </label>
                            <input type="text" id="internet_reference" name="reference_number"
                                   placeholder="Enter your internet account ID"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                        </div>

                        <button type="submit"
                                class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                            Check duplicate bill
                        </button>
                    </form>
                    @guest
                        <p class="mt-3 text-[11px] text-slate-500">
                            Create a free account to save your internet account IDs for quick checks next month.
                        </p>
                    @endguest
                </div>

                <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2">
                    <p class="text-xs font-semibold text-emerald-300">Stay online without surprises</p>
                    <ul class="text-[11px] space-y-1.5">
                        <li>Keep broadband and landline bills together.</li>
                        <li>Know when each bill is due before service suspension.</li>
                        <li>Use one quiet dashboard for all connectivity costs.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8 text-[13px] leading-relaxed text-slate-700">
                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Why manage internet bills with CheckBill.pk</h2>
                    <p class="mb-2">
                        Internet bills affect the entire family or office. A missed PTCL, Nayatel or StormFiber payment can
                        mean dropped Zoom calls and unhappy clients. CheckBill.pk brings these payment reminders into the same
                        routine as your electricity and gas bills.
                    </p>
                    <p>
                        By saving your internet account IDs inside your dashboard, you reduce the friction of logging into multiple
                        provider portals and remembering separate usernames.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Roman Urdu explanation</h2>
                    <p class="text-[12px] text-slate-600">
                        Aksar hum PTCL, Nayatel ya StormFiber ka internet istamal karte hain lekin bill check karne ke liye alag
                        alag websites par jate rehte hain. CheckBill.pk ka idea yeh hai ke electricity, gas aur internet ke sab
                        bills ek hi jagah se manage hon.
                        <br><br>
                        Yahan se aap PTCL bill online dekh sakte hain, Nayatel aur StormFiber ke account IDs save kar sakte hain
                        aur jab due date kareeb aaye to jaldi se duplicate bill nikal kar payment kar dein. Is se connection band
                        hone ka risk kam ho jata hai aur aap ka dimaag free rehta hai.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection


