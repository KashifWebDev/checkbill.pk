@extends('layouts.app')

@section('title', 'Sign in to CheckBill.pk')
@section('meta_description', 'Sign in to your CheckBill.pk account to access your saved bills, due dates, and email reminder settings.')
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
                    Welcome back.
                </h1>
                <p class="text-base text-slate-600 leading-relaxed">
                    Access your saved reference numbers, check new bills in one click, and manage email reminders from your dashboard.
                </p>
            </div>

            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 text-slate-50 space-y-4">
                <p class="text-sm font-semibold text-emerald-300 flex items-center gap-2">
                    <iconify-icon icon="lucide:sparkles" width="16"></iconify-icon>
                    What you'll see after sign in
                </p>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-800/50">
                        <span class="text-slate-300">Saved meters</span>
                        <span class="font-bold text-emerald-300">3 active</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-800/50">
                        <span class="text-slate-300">Next reminder</span>
                        <span class="font-bold text-amber-300">Before 10 Jan</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-800/50">
                        <span class="text-slate-300">Late fees avoided</span>
                        <span class="font-bold text-green-300">₨ 1,200 saved</span>
                </div>
                </div>
            </div>

            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5">
                <p class="text-xs font-semibold text-emerald-900 mb-2">New to CheckBill.pk?</p>
                <p class="text-sm text-emerald-800 mb-4">Create a free account to save all your bill reference numbers and get email reminders before due dates.</p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-800 group">
                    Create free account
                    <iconify-icon icon="lucide:arrow-right" width="14" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                </a>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-full">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Sign in</h2>

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

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:mail" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                        <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:lock" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all">
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer accent-green-600">
                            <span class="text-slate-600">Keep me signed in</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Sign in to Dashboard
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>

                    <p class="text-sm text-slate-500 text-center">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">Create a free account</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
