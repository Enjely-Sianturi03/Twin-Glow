<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        if (!Auth::check() || Auth::id() !== $invoice->booking->user_id) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        return view('invoice', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        if (!Auth::check() || Auth::id() !== $invoice->booking->user_id) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        // Here you can implement PDF generation logic
        // For now, we'll just return the view
        return view('invoice-pdf', compact('invoice'));
    }
} 