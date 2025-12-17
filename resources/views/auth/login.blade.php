<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to CheckBill.pk</title>
    <meta name="description" content="Sign in to your CheckBill.pk account to access your saved bills, due dates, and email reminder settings.">
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
                    Welcome back.
                </h1>
                <p class="text-sm text-slate-500">
                    Access your saved reference numbers, check new bills in one click, and manage email reminders.
                </p>
            </div>

            <div class="rounded-2xl bg-slate-900 text-slate-50 p-4 space-y-2">
                <p class="text-xs font-semibold text-emerald-300">What you see after sign in</p>
                <div class="mt-2 space-y-2 text-[11px] text-slate-200">
                    <div class="flex items-center justify-between">
                        <p>3 saved meters</p>
                        <p class="text-emerald-300 font-semibold">1 paid • 2 due</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p>Next reminder email</p>
                        <p class="text-amber-300 font-semibold">Before 10 Jan</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p>Last late fee avoided</p>
                        <p class="text-rose-300 font-semibold">₨ 1,200 saved</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-full">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Sign in</h2>

                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-rose-100 bg-rose-50 text-rose-700 text-xs p-3 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-1">
                        <label for="email" class="text-xs font-semibold text-slate-700">Email</label>
                        <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="text-xs font-semibold text-slate-700">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-slate-500">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-slate-300 text-green-600 focus:ring-green-500">
                            <span>Keep me signed in on this device</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-md hover:bg-slate-800 transition">
                        Sign in
                    </button>

                    <p class="text-[11px] text-slate-500 text-center">
                        New to CheckBill.pk?
                        <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">Create a free account</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


