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
    public function index()
    {
        $totalGuests = Guest::count();
        $totalBookings = Booking::count();
        $totalPayments = Payment::sum('amount');
        $totalTestimonials = Testimonial::count();
        
        $recentBookings = Booking::with(['guest', 'service'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentTestimonials = Testimonial::with('guest')
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
} 