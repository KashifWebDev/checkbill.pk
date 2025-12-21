<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->get();

        $featuredPost = $blogs->first(); // Most recent post

        // Get categories for filter display (no filtering functionality)
        $categories = Blog::where('published_at', '<=', now())
            ->distinct()
            ->pluck('category')
            ->toArray();

        return view('blogs.index', [
            'blogs' => $blogs,
            'featuredPost' => $featuredPost,
            'categories' => $categories,
        ]);
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedPosts = $blog->getRelated(3);

        return view('blogs.show', [
            'blog' => $blog,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email]
        );

        return back()->with('newsletter_success', 'Thank you for subscribing! You\'ll receive updates in your inbox.');
    }
}
