<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan dashboard utama admin
    public function index()
    {
        $bookings = Booking::all(); 
        return view('admin.dashboard', compact('bookings'));

        $totalGuests = Guest::count();
        $totalBookings = Booking::count();
        $totalPayments = Payment::sum('amount');
        $totalTestimonials = Testimonial::count();
        
        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentTestimonials = Testimonial::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalGuests',
            'totalBookings',
            'totalPayments',
            'totalTestimonials',
            'recentBookings',
            'recentTestimonials'
        ));
    }

    // Mengubah status booking (dipanggil dari tombol Confirm/Done/Cancel)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,done,cancelled'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = (string) $request->input('status');

        $booking->save();

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function dashboard()
    {
        $bookings = Booking::with(['user', 'service'])->get();
        return view('admin.dashboard', compact('bookings'));
    }

}
