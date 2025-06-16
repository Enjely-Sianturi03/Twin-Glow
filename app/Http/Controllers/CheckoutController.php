<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function show(Booking $booking)
    {
        if (!Auth::check() || Auth::id() !== $booking->user_id) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        $amount = $this->calculateAmount($booking->jenis_layanan);
        return view('checkout', compact('booking', 'amount'));
    }

    public function process(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:transfer,cash',
        ]);

        $now = Carbon::now();

        // Create payment record
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $this->calculateAmount($booking->jenis_layanan),
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_date' => $now,
        ]);
        // Update booking payment_method
        $booking->payment_method = $request->payment_method;
        $booking->save();

        // Create invoice
        $invoice = Invoice::create([
            'booking_id' => $booking->id,
            'payment_id' => $payment->id,
            'invoice_number' => 'INV-' . Str::random(8),
            'total_amount' => $payment->amount,
            'status' => 'sent',
            'issue_date' => $now,
            'due_date' => $now->copy()->addDays(7),
        ]);

        return redirect()->route('invoice.show', $invoice)
            ->with('success', 'Payment processed successfully');
    }

    private function calculateAmount($service)
    {
        // Define service prices
        $prices = [
            'haircut' => 150000,
            'coloring' => 350000,
            'facial' => 250000,
            'nails' => 120000,
            'massage' => 300000,
            'makeup' => 400000,
        ];

        return $prices[$service] ?? 0;
    }
} 