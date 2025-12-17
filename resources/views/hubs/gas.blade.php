@extends('layouts.app')

@section('title', 'Gas Bill Online in Pakistan — SNGPL & SSGC Duplicate Bills')
@section('meta_description', 'Check gas bills online for SNGPL and SSGC in Pakistan. Learn how to find your consumer number, download duplicate gas bills and save meters with CheckBill.pk.')
@section('canonical', url('/gas-bill-online'))

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="max-w-3xl">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                Gas bill online in Pakistan
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-4">
                Check your SNGPL or SSGC gas bill online, save your consumer number and avoid the rush of finding paper bills
                every month. CheckBill.pk keeps all your important meters in one calm place.
            </p>
            <p class="text-xs text-slate-500 mb-8">
                Whether you search “SNGPL bill online” or “SSGC gas bill check”, this page acts as your default starting point.
            </p>
        </div>

        <div class="grid md:grid-cols-[2fr,3fr] gap-8 items-start">
            <div class="space-y-4">
                <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold text-slate-900 mb-3">Quick gas bill lookup</h2>
                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="type" value="gas">
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="gas_provider">
                            Select gas company
                        </label>
                        <select id="gas_provider" name="provider" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                            <option value="sngpl">SNGPL (North)</option>
                            <option value="ssgc">SSGC (South)</option>
                        </select>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="gas_reference">
                                Consumer number / reference
                            </label>
                            <input type="text" id="gas_reference" name="reference_number"
                                   placeholder="Enter your consumer number"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                        </div>

                        <button type="submit"
                                class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                            Check duplicate bill
                        </button>
                    </form>
                    @guest
                        <p class="mt-3 text-[11px] text-slate-500">
                            To skip typing this number every month,
                            <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">create a free CheckBill.pk account</a>.
                        </p>
                    @endguest
                </div>

                <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2">
                    <p class="text-xs font-semibold text-emerald-300">Gas bills without stress</p>
                    <ul class="text-[11px] space-y-1.5">
                        <li>Save gas consumer numbers for home and shop once.</li>
                        <li>See upcoming due dates in one place.</li>
                        <li>Use history to spot unusual usage in winter months.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8 text-[13px] leading-relaxed text-slate-700">
                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">SNGPL and SSGC from a single dashboard</h2>
                    <p class="mb-2">
                        CheckBill.pk focuses on SNGPL bill online and SSGC bill online experiences that are simple and predictable.
                        Many Pakistani families have one gas meter at home and another at a shop or parents’ house. Saving both
                        in one dashboard means you can quickly see which bills are due this month.
                    </p>
                    <p>
                        Instead of juggling two different websites, two different bookmark names and different layouts, this hub
                        keeps a common flow, so the only thing that changes is the company name.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">How to check your gas bill online</h2>
                    <p class="mb-2">
                        The first requirement is your gas consumer number. It is printed on the top area of your paper bill and
                        sometimes mentioned as “consumer no” or “account ID”.
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-600 mb-2">
                        <li>Select SNGPL or SSGC from the dropdown above.</li>
                        <li>Enter the consumer number exactly as it appears on the bill.</li>
                        <li>Click “Check duplicate bill” to load a placeholder summary.</li>
                        <li>Later this same flow will show gas units, amount and due date directly from the provider system.</li>
                    </ol>
                    <p>
                        If you want a deeper guide with screenshots, start with the dedicated
                        <a href="{{ route('providers.sngpl') }}" class="text-green-700 hover:text-green-800 font-medium">SNGPL bill online page</a>.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Roman Urdu explanation</h2>
                    <p class="text-[12px] text-slate-600">
                        Agar aap ka sawal hai “SNGPL bill online kaise check karein?” ya “SSGC ka gas bill kidhar se milega?” to
                        CheckBill.pk aap ke liye sab se aasaan raasta hai. Yahan pe aap sirf consumer number dalte hain aur
                        duplicate gas bill ka summary saamne aa jata hai.
                        <br><br>
                        Roz roz alag websites ya bookmarks yaad rakhne ke bajaye, ek hi jagah se sab gas bills handle honge.
                        Aap apne ghar aur dukan ke gas numbers ek dafa save kar dein. Phir agle mahine jab gas bill ka khayal
                        aaye, CheckBill.pk kholen, meter ka naam select karein aur foran check karein ke kitna bill bana hai
                        aur due date kab hai.
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-900 mb-2">Make late payment surcharge rare</h2>
                    <p class="text-[12px] text-slate-600">
                        Gas bills often feel small compared to electricity, so they are easy to forget. A short delay adds an
                        annoying late payment surcharge. With a free CheckBill.pk account, you can get quiet reminders before
                        the last date so that you pay on time without needing to keep the original paper bill on the fridge.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection


