@extends('layouts.app')

@section('title', 'Contact Us | CheckBill.pk')
@section('meta_description', 'Contact CheckBill.pk for support, questions, or feedback about our utility bill checking services in Pakistan. We are here to help.')
@section('canonical', config('app.url') . '/contact-us')

@php
    $baseUrl = config('app.url');
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $baseUrl . '/',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Contact Us',
                'item' => $baseUrl . '/contact-us',
            ],
        ],
    ];

    $organizationSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'CheckBill.pk',
        'url' => $baseUrl,
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'email' => 'support@checkbill.pk',
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6">
    <!-- Header -->
    <div class="text-center mb-6 sm:mb-8 md:mb-12">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-3 sm:mb-4">Contact Us</h1>
        <p class="text-sm sm:text-base text-slate-600">We're here to help! Get in touch with us for support, questions, or feedback.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
        <!-- Contact Information -->
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-slate-200 p-4 sm:p-6 md:p-8">
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4 sm:mb-6">Get in Touch</h2>
            
            <div class="space-y-4 sm:space-y-6">
                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-orange-100 flex items-center justify-center">
                        <iconify-icon icon="lucide:mail" class="text-orange-600" width="20" style="width: 20px; height: 20px;"></iconify-icon>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900 uppercase tracking-wide mb-1">Email</h3>
                        <p class="text-sm sm:text-base text-slate-700 break-words">
                            <a href="mailto:support@checkbill.pk" class="text-orange-600 hover:text-orange-700 underline break-all">support@checkbill.pk</a>
                        </p>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">We typically respond within 24-48 hours</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-orange-100 flex items-center justify-center">
                        <iconify-icon icon="lucide:clock" class="text-orange-600" width="20" style="width: 20px; height: 20px;"></iconify-icon>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900 uppercase tracking-wide mb-1">Response Time</h3>
                        <p class="text-sm sm:text-base text-slate-700">24-48 hours</p>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">Monday - Friday, 9 AM - 6 PM PKT</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-orange-100 flex items-center justify-center">
                        <iconify-icon icon="lucide:help-circle" class="text-orange-600" width="20" style="width: 20px; height: 20px;"></iconify-icon>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900 uppercase tracking-wide mb-1">Support</h3>
                        <p class="text-sm sm:text-base text-slate-700">For technical issues or questions about using CheckBill.pk</p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-slate-200">
                <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-3 sm:mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('pages.privacy') }}" class="text-sm text-slate-600 hover:text-slate-900 transition flex items-center gap-2">
                            <iconify-icon icon="lucide:file-text" width="16"></iconify-icon>
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.terms') }}" class="text-sm text-slate-600 hover:text-slate-900 transition flex items-center gap-2">
                            <iconify-icon icon="lucide:file-text" width="16"></iconify-icon>
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs.index') }}" class="text-sm text-slate-600 hover:text-slate-900 transition flex items-center gap-2">
                            <iconify-icon icon="lucide:book-open" width="16"></iconify-icon>
                            Help & Guides
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-slate-200 p-4 sm:p-6 md:p-8">
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4 sm:mb-6">Send us a Message</h2>
            
            <form id="contact-form" action="{{ route('pages.contact.submit') }}" method="POST" class="space-y-3 sm:space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Your Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all min-h-[48px]">
                </div>

                <div>
                    <label for="email" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required
                           class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all min-h-[48px]">
                </div>

                <div>
                    <label for="subject" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Subject</label>
                    <select id="subject" name="subject" required
                            class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-sm font-medium text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all min-h-[48px]">
                        <option value="">Select a subject...</option>
                        <option value="support">Technical Support</option>
                        <option value="question">General Question</option>
                        <option value="feedback">Feedback</option>
                        <option value="bug">Report a Bug</option>
                        <option value="feature">Feature Request</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label for="message" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all resize-none"></textarea>
                </div>

                <!-- Math Captcha -->
                <div class="bg-slate-50 rounded-lg sm:rounded-xl p-3 sm:p-4 border-2 border-slate-200 overflow-hidden">
                    <label for="captcha" class="block text-xs sm:text-sm font-bold text-slate-700 mb-2">
                        Security Check
                        <span class="text-xs font-normal text-slate-500">(to prevent spam)</span>
                    </label>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3 w-full">
                        <div class="flex-shrink-0 w-full sm:w-auto text-center">
                            <div class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 bg-white rounded-lg px-3 sm:px-4 py-2 border-2 border-slate-300 whitespace-nowrap inline-block">
                                {{ $captcha_question }} = ?
                            </div>
                        </div>
                        <input type="number" id="captcha" name="captcha" required
                               class="flex-1 min-w-0 rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all min-h-[48px]"
                               placeholder="Enter answer">
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Solve the math problem above to verify you're human.</p>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-orange-600 to-amber-600 text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-200 min-h-[48px] flex items-center justify-center gap-2 text-sm sm:text-base">
                    <iconify-icon icon="lucide:send" width="18" style="width: 18px; height: 18px;"></iconify-icon>
                    <span>Send Message</span>
                </button>

                <div id="form-message" class="hidden mt-3 sm:mt-4 p-3 sm:p-4 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium"></div>
            </form>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mt-6 sm:mt-8 md:mt-12 bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-slate-200 p-4 sm:p-6 md:p-8">
        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4 sm:mb-6">Frequently Asked Questions</h2>
        
        <div class="space-y-3 sm:space-y-4">
            <div class="border-b border-slate-200 pb-3 sm:pb-4">
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 mb-1.5 sm:mb-2">How do I check my utility bill?</h3>
                <p class="text-sm sm:text-base text-slate-700">Select your utility provider, enter your reference number, and click "Check duplicate bill". You'll see your bill details instantly.</p>
            </div>

            <div class="border-b border-slate-200 pb-3 sm:pb-4">
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 mb-1.5 sm:mb-2">Is CheckBill.pk free to use?</h3>
                <p class="text-sm sm:text-base text-slate-700">Yes! Checking bills is completely free. Creating an account to save your reference numbers is also free.</p>
            </div>

            <div class="border-b border-slate-200 pb-3 sm:pb-4">
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 mb-1.5 sm:mb-2">Where can I find my reference number?</h3>
                <p class="text-sm sm:text-base text-slate-700">Your reference number is printed on the top of your utility bill. Check our <a href="/blog/find-reference-number" class="text-orange-600 hover:text-orange-700 underline">guide</a> for detailed instructions.</p>
            </div>

            <div>
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 mb-1.5 sm:mb-2">Can I pay my bill through CheckBill.pk?</h3>
                <p class="text-sm sm:text-base text-slate-700">No, we only provide bill checking and duplicate bill download services. You'll need to pay through your utility provider's official payment channels.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Form submission
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const submitButton = form.querySelector('button[type="submit"]');
    const messageDiv = document.getElementById('form-message');
    const formData = new FormData(form);
    
    // Disable submit button
    submitButton.disabled = true;
    submitButton.innerHTML = '<iconify-icon icon="lucide:loader-2" width="20" class="animate-spin"></iconify-icon> Sending...';
    messageDiv.classList.add('hidden');
    
    // Submit via AJAX
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageDiv.className = 'mt-4 p-4 rounded-xl text-sm font-medium bg-green-50 text-green-700 border border-green-200';
            messageDiv.textContent = data.message;
            messageDiv.classList.remove('hidden');
            form.reset();
            // Clear captcha field
            document.getElementById('captcha').value = '';
        } else {
            messageDiv.className = 'mt-4 p-4 rounded-xl text-sm font-medium bg-red-50 text-red-700 border border-red-200';
            messageDiv.textContent = data.message || 'Please check the form and try again.';
            messageDiv.classList.remove('hidden');
            
            // Clear captcha field on error so user can try again
            if (data.errors && data.errors.captcha) {
                document.getElementById('captcha').value = '';
            }
        }
        
        submitButton.disabled = false;
        submitButton.innerHTML = '<iconify-icon icon="lucide:send" width="20"></iconify-icon> Send Message';
        
        // Scroll to message
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    })
    .catch(error => {
        messageDiv.className = 'mt-4 p-4 rounded-xl text-sm font-medium bg-red-50 text-red-700 border border-red-200';
        messageDiv.textContent = 'Sorry, there was an error sending your message. Please try again later.';
        messageDiv.classList.remove('hidden');
        
        submitButton.disabled = false;
        submitButton.innerHTML = '<iconify-icon icon="lucide:send" width="20"></iconify-icon> Send Message';
        
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});
</script>
@endpush
@endsection

