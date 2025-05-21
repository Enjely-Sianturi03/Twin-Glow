<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'testimoni' => 'required|string|min:10',
        ]);

        // Set is_approved to true by default for now
        $validated['is_approved'] = true;
        
        Testimonial::create($validated);

        return redirect()->back()
            ->with('testimonial_success', 'Testimonial submitted successfully!')
            ->with('alert_type', 'success');
    }

    public function index()
    {
        $testimonials = Testimonial::where('is_approved', true)
            ->latest()
            ->get();

        return view('testimonials', compact('testimonials'));
    }
}
