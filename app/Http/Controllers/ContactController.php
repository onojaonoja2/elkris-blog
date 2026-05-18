<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('blog.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        ContactMessage::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent. We will get back to you shortly.']);
        }

        return redirect()->route('contact')
            ->with('success', 'Your message has been sent. We will get back to you shortly.');
    }
}
