@extends('layouts.app')

@section('title', 'Electricity Bill Online in Pakistan — Check & Save with CheckBill.pk')
@section('meta_description', 'Check electricity bills online in Pakistan for IESCO, LESCO, MEPCO, FESCO, PESCO, GEPCO, HESCO, SEPCO, QESCO, TESCO and K-Electric. Learn how to save meters and get reminders with CheckBill.pk.')
@section('canonical', url('/electricity-bill-online'))

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="max-w-3xl">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                Electricity bill online in Pakistan
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-4">
                Use CheckBill.pk as your monthly companion for electricity bills across Pakistan. In one place you can
                check duplicate bills, remember reference numbers and prepare before the due date.
            </p>
            <p class="text-xs text-slate-500 mb-8">
                Instead of searching “IESCO bill online”, “LESCO bill online” or “K Electric bill” every month, bookmark this page once
                and reach all providers from here.
            </p>
        </div>

        <div class="grid md:grid-cols-[2fr,3fr] gap-8 items-start">
            <div class="space-y-4">
                <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold text-slate-900 mb-3">Quick electricity bill lookup</h2>
                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="type" value="electricity">
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="provider">
                            Select provider
                        </label>
                        <select id="provider" name="provider" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                            <option value="iesco">IESCO (Islamabad)</option>
                            <option value="lesco">LESCO (Lahore)</option>
                            <option value="mepco">MEPCO (Multan)</option>
                            <option value="fesco">FESCO (Faisalabad)</option>
                            <option value="pesco">PESCO (Peshawar)</option>
                            <option value="gepco">GEPCO (Gujranwala)</option>
                            <option value="hesco">HESCO (Hyderabad)</option>
                            <option value="sepco">SEPCO (Sukkur)</option>
                            <option value="qesco">QESCO (Quetta)</option>
                            <option value="tesco">TESCO (Tribal Areas)</option>
                            <option value="ke">K-Electric (Karachi)</option>
                        </select>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="reference_number">
                                Reference number
                            </label>
                            <input type="text" id="reference_number" name="reference_number"
                                   placeholder="Enter 14 digit reference number"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                        </div>

                        <button type="submit"
                                class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                            Check duplicate bill
                        </button>
                    </form>
                    @guest
                        <p class="mt-3 text-[11px] text-slate-500">
                            Want to save this meter for one-click checks next month?
                            <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">Create a free account</a>.
                        </p>
                    @endguest
                </div>

                <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2">
                    <p class="text-xs font-semibold text-emerald-300">Why create an account?</p>
                    <ul class="text-[11px] space-y-1.5">
                        <li>Save all your electricity meters (home, office, parents) once.</li>
                        <li>Next month just open your dashboard and tap “Check bill”.</li>
                        <li>See a simple history of how much you paid over time.</li>
                        <li>Get gentle email reminders before the due date.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8 text-[13px] leading-relaxed text-slate-700">
                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">All electricity providers in one place</h2>
                    <p class="mb-2">
                        CheckBill.pk brings the major Pakistani electricity companies into a single calm interface. Whether your
                        meter is in Islamabad, Lahore, Karachi, Multan or Peshawar, you do not need to remember different URLs.
                    </p>
                    <ul class="list-disc list-inside text-slate-600 space-y-1 mb-3">
                        <li><a href="{{ route('providers.iesco') }}" class="text-green-700 hover:text-green-800 font-medium">IESCO bill online</a></li>
                        <li>LESCO, MEPCO, FESCO, PESCO, GEPCO, HESCO, SEPCO, QESCO, TESCO</li>
                        <li>K-Electric bill online for Karachi users</li>
                    </ul>
                    <p>
                        Over time you can save each meter in your account and turn this page into a launchpad for the bills you
                        actually care about, instead of a long list you have to search through every month.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">How to check an electricity bill online</h2>
                    <p class="mb-2">
                        For most Pakistani distribution companies the process is very similar. You only need the reference number
                        printed on your physical bill.
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-600 mb-2">
                        <li>Select your company from the provider dropdown above.</li>
                        <li>Enter the reference number exactly as shown on your bill.</li>
                        <li>Tap “Check duplicate bill” to see placeholder details for now.</li>
                        <li>Once integrations are live, you will see bill amount, due date and payable after due date.</li>
                    </ol>
                    <p>
                        If you are not sure where to find the reference number, our detailed provider pages such as the
                        <a href="{{ route('providers.iesco') }}" class="text-green-700 hover:text-green-800 font-medium">IESCO bill online guide</a>
                        include screenshots and step-by-step help.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Why saving meters matters</h2>
                    <p class="mb-2">
                        Most Pakistani households now manage several electricity bills at once – home, parents, a small office or
                        shop. Finding and typing reference numbers again and again is the small annoying task that eats your time.
                    </p>
                    <p class="mb-2">
                        When you create a CheckBill.pk account, you can save each meter once. The next month you simply recognise
                        the meter name – “Home”, “Parents house”, “Office” – and click “Check bill”. This turns a 2–3 minute task
                        per bill into a few seconds.
                    </p>
                    <p>
                        It also builds a quiet history. Over time you can see how your units and amounts move, which is useful
                        in months of heavy load-shedding or price changes.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Roman Urdu explanation</h2>
                    <p class="text-[12px] text-slate-600">
                        Agar aap soch rahe hain “electricity bill online kaise check karun?”, to CheckBill.pk aap ke liye bana hai.
                        Yahan pe aap IESCO, LESCO, MEPCO ya kisi bhi company ka “duplicate bill” sirf reference number se dekh
                        sakte hain. Har mahine Google pe “IESCO bill online” search karne ki zaroorat nahi rehti.
                        <br><br>
                        Aap sirf ek dafa meter ka reference number save kar dein. Agle mahine jab bill ka khayal aaye, bas
                        CheckBill.pk kholen, “Home” ya “Office” select karein aur bill foran saamne aa jayega. Isi tarah due date
                        bhi nazar aa jayegi, taake aap late payment surcharge se bach sakte hain. Ye sab free hai, sirf email
                        se account banta hai, koi CNIC ya extra details nahi mangte.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Soft signup invitation</h2>
                    <p class="text-[12px] text-slate-600">
                        You can freely use this page to check any electricity bill in Pakistan. When you are ready to make life
                        easier for your future self, create a free account so CheckBill.pk can remember your meters and gently
                        remind you before the last date.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection


