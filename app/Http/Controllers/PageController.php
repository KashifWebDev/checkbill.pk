<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function electricityHub()
    {
        return view('hubs.electricity');
    }

    public function gasHub()
    {
        return view('hubs.gas');
    }

    public function internetHub()
    {
        return view('hubs.internet');
    }

    public function provider(Request $request)
    {
        // Get slug from route defaults or request path
        $slug = $request->route()->defaults['slug'] ?? ltrim($request->path(), '/');
        
        // Load provider from config
        $allProviders = config('providers.providers');
        $provider = collect($allProviders)->firstWhere('slug', $slug);

        abort_unless($provider, 404);

        // Get related blogs for this provider
        $relatedBlogs = Blog::getByProvider($provider['key'], 5);

        // Use a dedicated provider view if it exists (e.g. providers.iesco),
        // otherwise fall back to the generic provider template so all routes work.
        $candidateView = 'providers.' . $provider['key'];
        $viewName = view()->exists($candidateView) ? $candidateView : 'providers.generic';

        return view($viewName, [
            'provider' => $provider,
            'slug' => $slug,
            'relatedBlogs' => $relatedBlogs,
        ]);
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function termsOfService()
    {
        return view('pages.terms-of-service');
    }

    public function contactUs()
    {
        // Generate a simple math captcha
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $operation = rand(0, 1) ? '+' : '-';
        
        if ($operation === '+') {
            $answer = $num1 + $num2;
        } else {
            // Ensure positive result for subtraction
            if ($num1 < $num2) {
                $temp = $num1;
                $num1 = $num2;
                $num2 = $temp;
            }
            $answer = $num1 - $num2;
        }
        
        // Store answer in session
        session(['captcha_answer' => $answer]);
        
        return view('pages.contact-us', [
            'captcha_question' => "{$num1} {$operation} {$num2}",
        ]);
    }

    public function submitContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'captcha' => 'required|integer',
        ]);

        // Validate captcha
        $captchaAnswer = session('captcha_answer');
        if (!$captchaAnswer || (int)$request->captcha !== $captchaAnswer) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid captcha answer. Please try again.',
                'errors' => ['captcha' => ['The captcha answer is incorrect.']]
            ], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in all required fields correctly.',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Clear captcha from session after successful validation
        session()->forget('captcha_answer');

        try {
            ContactSubmission::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // TODO: Add email notification here if needed
            // Mail::to('support@checkbill.pk')->send(new ContactSubmissionMail($submission));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We\'ll get back to you within 24-48 hours.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.'
            ], 500);
        }
    }
}


