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
        try {
            $request->validate([
                'status' => 'required|in:pending,confirmed,done,cancelled'
            ]);

            $booking = Booking::findOrFail($id);
            
            // If status is set to done
            if ($request->input('status') === 'done') {
                // Check if booking is still pending
                if ($booking->status === 'pending') {
                    return redirect()->back()
                        ->with('error', 'Tidak dapat menyelesaikan booking yang masih pending. Harap konfirmasi booking terlebih dahulu.');
                }
                
                // If confirmed, proceed with deletion
                if ($booking->status === 'confirmed') {
                    $booking->delete();
                    return redirect()->back()
                        ->with('success', 'Booking telah selesai dan dihapus dari sistem.');
                }
            }

            // For other status updates
            $booking->status = (string) $request->input('status');
            $booking->save();

            $statusMessages = [
                'confirmed' => 'Booking telah dikonfirmasi.',
                'cancelled' => 'Booking telah dibatalkan.',
                'pending' => 'Status booking diubah menjadi pending.'
            ];

            return redirect()->back()
                ->with('success', $statusMessages[$booking->status] ?? 'Status booking berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui status booking. Silakan coba lagi.');
        }
    }

    public function dashboard()
    {
        $bookings = Booking::with(['user', 'service'])->get();
        return view('admin.dashboard', compact('bookings'));
    }

}
