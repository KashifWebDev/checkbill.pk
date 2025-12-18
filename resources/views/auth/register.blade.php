@extends('layouts.app')

@section('title', 'Create your free CheckBill.pk account')
@section('meta_description', 'Create your free CheckBill.pk account to save all your bill reference numbers in one dashboard and get monthly email reminders before due dates.')
@section('robots', 'noindex,nofollow')

@section('body_class', 'bg-slate-50 text-slate-700 antialiased relative min-h-screen flex flex-col')

@section('main_class', 'flex items-center justify-center px-4 py-16')

@section('content')
    <div class="max-w-5xl w-full grid md:grid-cols-2 gap-10 bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 md:p-10">
        <div class="space-y-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-900 transition">
                <iconify-icon icon="lucide:arrow-left" width="14"></iconify-icon>
                Back to CheckBill.pk
            </a>

            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3">
                    One-click bills<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600">every month.</span>
                </h1>
                <p class="text-base text-slate-600 leading-relaxed">
                    Create a free account to save all your reference numbers, see bill history, and get email reminders before the due date.
                </p>
            </div>

            <div class="space-y-4">
                <div class="flex gap-4 items-start p-4 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200">
                    <div class="mt-0.5 w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm font-bold flex-shrink-0">1</div>
                    <div>
                        <p class="font-bold text-slate-900 mb-1">Save all your meters</p>
                        <p class="text-sm text-slate-600">Electricity, gas & internet – no more hunting for old paper bills or SMS screenshots.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start p-4 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200">
                    <div class="mt-0.5 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold flex-shrink-0">2</div>
                    <div>
                        <p class="font-bold text-slate-900 mb-1">Due-date email reminders</p>
                        <p class="text-sm text-slate-600">We email you a reminder before the last date so you avoid late payment surcharge.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start p-4 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-200">
                    <div class="mt-0.5 w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center text-sm font-bold flex-shrink-0">3</div>
                    <div>
                        <p class="font-bold text-slate-900 mb-1">Clean bill dashboard</p>
                        <p class="text-sm text-slate-600">See all your bills in one simple dashboard: status, due date, and quick duplicate download.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 text-slate-50">
                <p class="text-sm font-semibold text-emerald-300 mb-4 flex items-center gap-2">
                    <iconify-icon icon="lucide:sparkles" width="16"></iconify-icon>
                    Preview: Your future dashboard
                </p>
                <div class="grid grid-cols-3 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-800/50 space-y-1">
                        <p class="font-bold text-white">LESCO Home</p>
                        <p class="text-slate-300">Due: 12 Jan</p>
                        <p class="text-emerald-300 font-semibold">Paid</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/50 space-y-1">
                        <p class="font-bold text-white">IESCO Office</p>
                        <p class="text-slate-300">Due: 10 Jan</p>
                        <p class="text-amber-300 font-semibold">Due soon</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/50 space-y-1">
                        <p class="font-bold text-white">SNGPL Gas</p>
                        <p class="text-slate-300">Due: 18 Jan</p>
                        <p class="text-rose-300 font-semibold">Unpaid</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-full">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Create your free account</h2>

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border-2 border-rose-200 bg-rose-50 text-rose-700 text-sm p-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="flex items-center gap-2">
                                <iconify-icon icon="lucide:alert-circle" width="16"></iconify-icon>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Full name</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:user" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                            <input id="name" name="name" type="text" required autocomplete="name" value="{{ old('name') }}"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all"
                                   placeholder="Your full name">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Email for reminders</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:mail" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                            <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all"
                                   placeholder="your.email@example.com">
                        </div>
                        <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                            <iconify-icon icon="lucide:shield-check" width="12"></iconify-icon>
                            We only use this to send bill reminders. No spam.
                        </p>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:lock" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all"
                                   placeholder="Create a strong password">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Confirm password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:lock" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all"
                                   placeholder="Confirm your password">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Create Free Account
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>

                    <p class="text-sm text-slate-500 text-center">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-green-700 hover:text-green-800">Sign in instead</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
