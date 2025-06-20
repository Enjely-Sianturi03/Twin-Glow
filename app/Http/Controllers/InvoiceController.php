<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Menampilkan detail invoice ke pengguna yang sesuai.
     */
    public function show(Invoice $invoice)
    {
        // Cek apakah user yang sedang login adalah pemilik booking
        if (!Auth::check() || Auth::id() !== $invoice->booking->user_id) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        // Gunakan HTTPS dan timeout untuk API eksternal
        try {
            $response = Http::timeout(5)->get('https://worldtimeapi.org/api/timezone/Asia/Jakarta');

            // Jika berhasil, ambil waktu dari field 'datetime', jika tidak, gunakan waktu lokal
            $waktuSekarang = $response->successful()
                ? $response->json('datetime')
                : now('Asia/Jakarta')->toIso8601String();
        } catch (\Exception $e) {
            // Fallback jika terjadi error seperti koneksi gagal
            $waktuSekarang = now('Asia/Jakarta')->toIso8601String();
        }

        // Kirim ke view
        return view('invoice', compact('invoice', 'waktuSekarang'));
    }

    /**
     * Mengunduh invoice dalam format PDF.
     */
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

