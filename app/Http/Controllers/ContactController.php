<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Store a new testimonial.
     */
    public function store(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'You need to login to submit a testimonial.');
        }

        // Validate request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'testimoni' => 'required|string',
        ]);

        // Create contact record
        Contact::create($validated);

        return redirect()->back()->with('success', 'Testimonial submitted successfully!');
    }
} 