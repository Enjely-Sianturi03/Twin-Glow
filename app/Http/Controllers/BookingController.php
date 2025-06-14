<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.booking.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'You need to login to book a service.');
        }

        // Validation rules
        $validation = [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_tlp' => 'required|string|max:20',
            'jenis_layanan' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu' => 'required|string',
            'note' => 'nullable|string',
        ];

        // Add no_tlp validation if column exists
        if (Schema::hasColumn('users', 'no_tlp')) {
            $validation['no_tlp'] = 'required|string|max:20';
        }

        $validated = $request->validate($validation);

        // Create new booking
        $booking = new Booking();
        $booking->nama = $validated['nama'];
        $booking->email = $validated['email'];
        $booking->no_tlp = $validated['no_tlp'] ?? '';
        $booking->jenis_layanan = $validated['jenis_layanan'];
        $booking->tanggal = Carbon::parse($validated['tanggal'])->format('Y-m-d');
        $booking->waktu = $validated['waktu'];
        $booking->note = $validated['note'] ?? null;
        $booking->user_id = Auth::id();  // pastikan kolom user_id ada di tabel bookings
        $booking->status = 'pending';    // set default status

        $booking->save();

        // Redirect ke halaman checkout, ganti dengan route yang benar kalau perlu
        return redirect()->route('checkout.show', $booking->id)
            ->with('success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }

    public function create()
    {
        return view('admin.booking.create'); 
    }

    public function edit(Booking $booking)
    {
        return view('admin.booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'jenis_layanan' => 'required|string',
        'tanggal' => 'required|date_format:Y-m-d',
        'waktu' => 'required|string',
        'note' => 'nullable|string',
        'status' => 'required|in:pending,confirmed,cancelled',
        // tambahkan validasi lain jika perlu
    ]);

    $booking->update($validated);

    return redirect()->route('admin.booking.index')->with('success', 'Booking updated successfully.');
}


}
