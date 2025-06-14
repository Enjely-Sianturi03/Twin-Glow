<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10); 
        return view('admin.contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'You need to login to submit a testimonial.');
        }

        // Validate only testimoni, karena nama & email dari Auth
        $validated = $request->validate([
            'testimoni' => 'required|string',
        ]);

        // Ambil user login
        $user = Auth::user();

        // Simpan data ke database
        Contact::create([
            'nama' => $user->name,
            'email' => $user->email,
            'testimoni' => $validated['testimoni'],
        ]);

        return redirect()->back()->with('success', 'Testimonial submitted successfully!');
    }

} 