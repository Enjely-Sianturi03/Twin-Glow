<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get(); 
        return view('admin.contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'Anda harus login terlebih dahulu untuk mengirim testimoni.');
        }

        // Check if user is admin
        if (Auth::user()->email === 'red@gmail.com') {
            abort(403, 'Admin tidak diperbolehkan mengirim testimoni.');
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

        return redirect()->back()->with('testimonial_success', 'Testimoni berhasil dikirim!');
    }

    public function postTestimoni($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        \App\Models\Testimonial::create([
            'nama' => $contact->nama,
            'email' => $contact->email,
            'testimoni' => $contact->testimoni,
            'is_approved' => true,
        ]);
        return redirect()->back()->with('testimonial_success', 'Testimoni berhasil diposting ke halaman utama!');
    }

    public function retractTestimoni($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        \App\Models\Testimonial::where('nama', $contact->nama)
            ->where('email', $contact->email)
            ->where('testimoni', $contact->testimoni)
            ->where('is_approved', true)
            ->delete();
        return redirect()->back()->with('testimonial_success', 'Testimoni berhasil ditarik dari halaman utama!');
    }

} 