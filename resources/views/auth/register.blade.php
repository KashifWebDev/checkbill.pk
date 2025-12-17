<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your free CheckBill.pk account</title>
    <meta name="description" content="Create your free CheckBill.pk account to save all your bill reference numbers in one dashboard and get monthly email reminders before due dates.">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center px-4">
    <div class="max-w-4xl w-full grid md:grid-cols-2 gap-10 bg-white rounded-3xl shadow-xl border border-slate-100 p-6 md:p-10">
        <div class="space-y-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-900">
                <span class="inline-flex items-center justify-center w-7 h-7 rounded-xl bg-slate-900 text-white">
                    <span class="text-[11px] font-bold">CB</span>
                </span>
                <span>Back to CheckBill.pk</span>
            </a>

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">
                    One-click bills every month.
                </h1>
                <p class="text-sm text-slate-500">
                    Create a free account to save all your reference numbers, see bill history, and get email reminders before the due date.
                </p>
            </div>

            <div class="space-y-4 text-xs text-slate-600">
                <div class="flex gap-3 items-start">
                    <div class="mt-0.5 w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-[11px] font-bold">1</div>
                    <div>
                        <p class="font-semibold text-slate-900">Save all your meters in one place</p>
                        <p class="mt-1 text-slate-500">Electricity, gas & internet – no more hunting for old paper bills or SMS screenshots.</p>
                    </div>
                </div>
                <div class="flex gap-3 items-start">
                    <div class="mt-0.5 w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[11px] font-bold">2</div>
                    <div>
                        <p class="font-semibold text-slate-900">Due-date email reminders</p>
                        <p class="mt-1 text-slate-500">We email you a reminder before the last date so you avoid late payment surcharge.</p>
                    </div>
                </div>
                <div class="flex gap-3 items-start">
                    <div class="mt-0.5 w-6 h-6 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-[11px] font-bold">3</div>
                    <div>
                        <p class="font-semibold text-slate-900">Clean bill dashboard</p>
                        <p class="mt-1 text-slate-500">See all your bills in one simple dashboard: status, due date, and quick duplicate download.</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-slate-900 text-slate-50 p-4 space-y-2">
                <p class="text-xs font-semibold text-emerald-300">Preview: Your future dashboard</p>
                <div class="mt-2 grid grid-cols-3 gap-3 text-[10px] text-slate-200">
                    <div class="space-y-1">
                        <p class="font-semibold text-white">LESCO Home</p>
                        <p>Due: 12 Jan</p>
                        <p class="text-emerald-300 font-semibold">Paid</p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-semibold text-white">IESCO Office</p>
                        <p>Due: 10 Jan</p>
                        <p class="text-amber-300 font-semibold">Due soon</p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-semibold text-white">SNGPL Gas</p>
                        <p>Due: 18 Jan</p>
                        <p class="text-rose-300 font-semibold">Unpaid</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-full">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Create your free account</h2>

                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-rose-100 bg-rose-50 text-rose-700 text-xs p-3 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-1">
                        <label for="name" class="text-xs font-semibold text-slate-700">Full name</label>
                        <input id="name" name="name" type="text" required autocomplete="name" value="{{ old('name') }}"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="text-xs font-semibold text-slate-700">Email for reminders</label>
                        <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                        <p class="text-[10px] text-slate-400 mt-1">We will only use this to send bill reminders. No spam.</p>
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="text-xs font-semibold text-slate-700">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                    </div>

                    <div class="space-y-1">
                        <label for="password_confirmation" class="text-xs font-semibold text-slate-700">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-md hover:bg-slate-800 transition">
                        Create free account
                    </button>

                    <p class="text-[11px] text-slate-500 text-center">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-green-700 hover:text-green-800">Sign in instead</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


