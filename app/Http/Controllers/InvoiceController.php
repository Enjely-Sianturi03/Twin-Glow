<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $pdf = Pdf::loadView('invoice-pdf', compact('invoice'));
        $filename = 'Invoice-' . $invoice->invoice_number . '.pdf';
        return $pdf->download($filename);
    }
} 