<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your CheckBill.pk dashboard</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="relative w-9 h-9 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-xl shadow-slate-900/10">
                    <span class="text-[13px] font-bold">CB</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-bold tracking-tight text-slate-900 leading-none">CheckBill.pk</span>
                    <span class="text-[10px] font-medium text-slate-500 uppercase tracking-wider mt-0.5">Bill Dashboard</span>
                </div>
            </a>

            <div class="flex items-center gap-4">
                <p class="text-xs text-slate-500 hidden sm:block">
                    Signed in as <span class="font-semibold text-slate-800">{{ $user->name }}</span>
                </p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-3 py-1.5 text-[11px] font-semibold text-slate-600 hover:bg-slate-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 space-y-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Your bills at a glance</h1>
                    <p class="text-sm text-slate-500 mt-1">This is where your saved meters and upcoming bills will appear.</p>
                </div>

                <div class="flex flex-col items-end gap-2">
                    <div class="rounded-2xl bg-slate-900 text-slate-50 px-4 py-3 text-xs max-w-xs">
                        <p class="font-semibold text-emerald-300">Coming soon</p>
                        <p class="mt-1 text-slate-100">Automatic bill history and monthly email reminders based on the meters you save.</p>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div class="rounded-2xl bg-white border border-dashed border-slate-200 p-6 flex flex-col items-center justify-center text-center">
                        <div class="w-10 h-10 rounded-2xl bg-slate-900 text-white flex items-center justify-center mb-3">
                            <span class="text-[13px] font-bold">+</span>
                        </div>
                        <h2 class="text-sm font-semibold text-slate-900 mb-1">No meters saved yet</h2>
                        <p class="text-xs text-slate-500 mb-3">
                            The first time you search a bill and choose “Save this bill for next time”, it will show up here.
                        </p>
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">
                            Check a bill now
                        </a>
                    </div>

                    <div class="rounded-2xl bg-white border border-slate-100 p-4">
                        <h3 class="text-xs font-semibold text-slate-900 mb-2">Bill history timeline (preview)</h3>
                        <p class="text-[11px] text-slate-500">
                            Soon you’ll see a simple, month-by-month history of each meter here – units, amount, and whether you paid on time.
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="rounded-2xl bg-white border border-slate-100 p-4">
                        <h3 class="text-xs font-semibold text-slate-900 mb-2">Email reminders</h3>
                        <p class="text-[11px] text-slate-500 mb-3">
                            We’ll send you a reminder email a few days before each bill’s due date so you don’t pay late fees.
                        </p>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-500">Status</span>
                            <span class="rounded-full bg-amber-50 text-amber-700 px-2 py-1 font-semibold">Launching soon</span>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 border border-emerald-100 p-4 text-[11px] text-emerald-900">
                        <p class="font-semibold mb-1">Tip for future you</p>
                        <p>Whenever you get a new connection (home, office, shop), save its reference number here once. From next month, checking the bill is a 2-click job.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>


