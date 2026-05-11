<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:newsletter_subscriptions,email',
        ]);

        NewsletterSubscription::create([
            'email' => $validated['email'],
            'subscribed_at' => now(),
        ]);

        return redirect()->route('home')
            ->with('success', 'You have been subscribed to our newsletter successfully.');
    }
}
