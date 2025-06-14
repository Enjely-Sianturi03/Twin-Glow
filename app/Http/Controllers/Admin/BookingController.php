<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
public function index()
{
    $bookingsAktif = Booking::orderBy('date', 'desc')->get(); // booking yang belum dihapus
    $bookingRiwayat = Booking::onlyTrashed()->orderBy('deleted_at', 'desc')->get(); // booking yang sudah soft deleted

    return view('booking.index', compact('bookingsAktif', 'bookingRiwayat'));
}

    // Tampilkan form tambah booking
    public function create()
    {
        return view('booking.create');
    }

    // Simpan booking baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'service'       => 'required|string|max:255',
            'date'          => 'required|date',
            'status'        => 'required|in:pending,confirmed,cancelled',
        ]);

        Booking::create($request->all());

        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    // Tampilkan form edit booking
    public function edit(Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    // Update booking
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'service'       => 'required|string|max:255',
            'date'          => 'required|date',
            'status'        => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($request->all());

        return redirect()->route('booking.index')->with('success', 'Booking berhasil diperbarui.');
    }

    // Hapus booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
    }
}
