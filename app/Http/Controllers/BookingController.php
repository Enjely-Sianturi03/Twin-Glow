<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'You need to login to book a service.');
        }

        // Validasi dasar untuk booking
        $validation = [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jenis_layanan' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu' => 'required|string',
            'note' => 'nullable|string',
        ];
        
        // Tambahkan validasi no_tlp jika kolom tersedia di tabel users
        if (Schema::hasColumn('users', 'no_tlp')) {
            $validation['no_tlp'] = 'required|string|max:20';
        }
        
        $validated = $request->validate($validation);

        // Create booking (jika no_tlp tidak ada di validasi, isi dengan string kosong)
        $booking = new Booking();
        $booking->nama = $validated['nama'];
        $booking->email = $validated['email']; 
        $booking->no_tlp = $validated['no_tlp'] ?? '';
        $booking->jenis_layanan = $validated['jenis_layanan'];
        $booking->tanggal = Carbon::parse($validated['tanggal'])->format('Y-m-d');
        $booking->waktu = $validated['waktu'];
        $booking->note = $validated['note'] ?? null;
        $booking->user_id = Auth::id(); // Add user_id to the booking
        $booking->save();

        return redirect()->route('checkout.show', $booking)
            ->with('success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }
}