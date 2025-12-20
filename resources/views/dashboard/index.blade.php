@extends('layouts.app')

@section('title', 'Your CheckBill.pk Dashboard')
@section('meta_description', 'Personal dashboard for your saved electricity, gas and internet bills on CheckBill.pk.')
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-emerald-50 border-2 border-emerald-200 rounded-xl p-4 flex items-center gap-3 animate-fade-in-up">
            <iconify-icon icon="lucide:check-circle" width="20" class="text-emerald-600 flex-shrink-0"></iconify-icon>
            <p class="text-sm font-semibold text-emerald-900">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Header -->
        <div class="mb-12 animate-fade-in-up">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900 mb-3">
                        Welcome back, {{ $user->name }}
                    </h1>
                    <p class="text-lg text-slate-600">
                        Your bills at a glance. Check any saved meter with one click.
                    </p>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                    <iconify-icon icon="lucide:plus" width="16"></iconify-icon>
                    Add New Bill
                </a>
            </div>
        </div>

        @if ($savedBills->isEmpty())
            <!-- Empty State -->
            <div class="max-w-2xl mx-auto text-center mb-16 animate-fade-in-up animate-delay-100">
                <div class="bg-white rounded-3xl shadow-xl border-2 border-dashed border-slate-200 p-12">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-700 text-white flex items-center justify-center mb-6 mx-auto shadow-lg">
                        <iconify-icon icon="lucide:file-plus" width="32"></iconify-icon>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-3">No meters saved yet</h2>
                    <p class="text-slate-600 mb-6 max-w-md mx-auto">
                        The first time you check a bill and save it, it will appear here as a card with a one-click "Check now" button.
                    </p>
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                        <iconify-icon icon="lucide:search" width="16"></iconify-icon>
                        Check Your First Bill
                    </a>
                </div>
            </div>
        @else
            <!-- Saved Bills Grid -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Your Saved Bills</h2>
                    <span class="text-sm text-slate-500">{{ $savedBills->count() }} {{ $savedBills->count() === 1 ? 'meter' : 'meters' }} saved</span>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($savedBills as $bill)
                        <div class="dashboard-card bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-300 hover:shadow-xl transition-all relative">
                            <!-- Three Dots Menu -->
                            <div class="absolute top-4 right-4">
                                <button type="button" 
                                        class="bill-menu-button p-2 rounded-lg hover:bg-slate-100 transition-colors"
                                        data-bill-id="{{ $bill->id }}"
                                        onclick="toggleMenu({{ $bill->id }})">
                                    <iconify-icon icon="lucide:more-vertical" width="18" class="text-slate-600"></iconify-icon>
                                </button>
                                <!-- Dropdown Menu -->
                                <div id="menu-{{ $bill->id }}" class="hidden absolute right-0 top-full mt-2 w-40 bg-white rounded-xl shadow-xl border-2 border-slate-100 overflow-hidden z-10">
                                    <button type="button" 
                                            onclick="openEditModal({{ $bill->id }}, '{{ addslashes($bill->nickname ?: '') }}', '{{ addslashes($bill->provider_name) }}')"
                                            class="w-full text-left px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 flex items-center gap-2 transition-colors">
                                        <iconify-icon icon="lucide:edit" width="16"></iconify-icon>
                                        Edit
                                    </button>
                                    <button type="button" 
                                            onclick="openDeleteModal({{ $bill->id }}, '{{ addslashes($bill->nickname ?: $bill->provider_name) }}')"
                                            class="w-full text-left px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors">
                                        <iconify-icon icon="lucide:trash-2" width="16"></iconify-icon>
                                        Delete
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-start justify-between mb-4 pr-8">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-10 h-10 rounded-xl {{ $bill->type === 'electricity' ? 'bg-orange-100' : ($bill->type === 'gas' ? 'bg-red-100' : 'bg-blue-100') }} flex items-center justify-center">
                                            <iconify-icon icon="lucide:{{ $bill->type === 'electricity' ? 'zap' : ($bill->type === 'gas' ? 'flame' : 'wifi') }}" width="18" class="{{ $bill->type === 'electricity' ? 'text-orange-600' : ($bill->type === 'gas' ? 'text-red-600' : 'text-blue-600') }}"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">{{ $bill->nickname ?: $bill->provider_name }}</p>
                                            <p class="text-xs text-slate-500">{{ ucfirst($bill->type) }} • {{ $bill->provider_name }}</p>
                                        </div>
                                    </div>
                                    <p class="text-[11px] text-slate-400 font-mono mt-2">Ref: {{ $bill->reference_number }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 pt-4 border-t border-slate-100">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-500">Last checked</span>
                                    <span class="font-semibold text-slate-700">
                                        @if ($bill->last_checked_at)
                                            {{ $bill->last_checked_at->diffForHumans() }}
                                        @else
                                            Not checked yet
                                        @endif
                                    </span>
                                </div>
                                <a href="{{ route('bills.check', ['type' => $bill->type, 'provider' => $bill->provider_key, 'reference_number' => $bill->reference_number]) }}"
                                   class="block w-full text-center rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 px-4 py-3 text-xs font-semibold text-white hover:shadow-lg hover:scale-[1.02] transition-all">
                                    Check Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl p-6 border-2 border-emerald-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg">
                        <iconify-icon icon="lucide:sparkles" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Recognition & Routine</h3>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Each time you return, your dashboard remembers where you left off – which bills you checked and when. Think of this as your private "bill control centre".
                </p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center shadow-lg">
                        <iconify-icon icon="lucide:lightbulb" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Tip for Future You</h3>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Whenever you get a new connection (home, office, shop), save its reference number here once. From next month, checking the bill is a one-click habit instead of a small headache.
                </p>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity" onclick="closeEditModal()"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editBillForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-6 py-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-slate-900">Edit Bill</h3>
                            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                                <iconify-icon icon="lucide:x" width="20"></iconify-icon>
                            </button>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2" for="editNickname">
                                Nickname
                            </label>
                            <input type="text" 
                                   id="editNickname" 
                                   name="nickname"
                                   placeholder="e.g. Home ground floor, Parents house, Office"
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all min-h-[48px]">
                            <p class="text-xs text-slate-500 mt-2">Leave empty to use provider name</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-xs text-slate-500">
                                <span class="font-semibold">Provider:</span> <span id="editProviderName"></span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 flex flex-col sm:flex-row gap-3 justify-end">
                        <button type="button" 
                                onclick="closeEditModal()"
                                class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-colors min-h-[48px]">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-emerald-600 to-green-600 rounded-xl hover:shadow-lg transition-all min-h-[48px]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity" onclick="closeDeleteModal()"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="deleteBillForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-6 py-5">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mx-auto mb-4">
                            <iconify-icon icon="lucide:alert-triangle" width="32" class="text-red-600"></iconify-icon>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 text-center mb-2">Delete Bill?</h3>
                        <p class="text-sm text-slate-600 text-center mb-4">
                            Are you sure you want to delete <span class="font-semibold text-slate-900" id="deleteBillName"></span>? This action cannot be undone.
                        </p>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 flex flex-col sm:flex-row gap-3 justify-end">
                        <button type="button" 
                                onclick="closeDeleteModal()"
                                class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-colors min-h-[48px]">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-red-700 rounded-xl hover:shadow-lg transition-all min-h-[48px]">
                            Delete Bill
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Close menus when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.bill-menu-button') && !event.target.closest('[id^="menu-"]')) {
                document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        function toggleMenu(billId) {
            const menu = document.getElementById('menu-' + billId);
            const allMenus = document.querySelectorAll('[id^="menu-"]');
            
            // Close all other menus
            allMenus.forEach(m => {
                if (m.id !== menu.id) {
                    m.classList.add('hidden');
                }
            });
            
            // Toggle current menu
            menu.classList.toggle('hidden');
        }

        function openEditModal(billId, currentNickname, providerName) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editBillForm');
            const nicknameInput = document.getElementById('editNickname');
            const providerNameSpan = document.getElementById('editProviderName');
            
            form.action = `/dashboard/bills/${billId}`;
            nicknameInput.value = currentNickname;
            providerNameSpan.textContent = providerName;
            
            // Close menu
            document.getElementById('menu-' + billId).classList.add('hidden');
            
            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openDeleteModal(billId, billName) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteBillForm');
            const billNameSpan = document.getElementById('deleteBillName');
            
            form.action = `/dashboard/bills/${billId}`;
            billNameSpan.textContent = billName;
            
            // Close menu
            document.getElementById('menu-' + billId).classList.add('hidden');
            
            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close modals on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEditModal();
                closeDeleteModal();
            }
        });
    </script>
    @endpush
@endsection
