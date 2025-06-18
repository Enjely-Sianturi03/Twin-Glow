@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Invoice</h4>
                    <a href="{{ route('invoice.download', $invoice) }}" class="btn btn-light">
                        <i class="fas fa-download me-2"></i>Download PDF
                    </a>
                </div>
                <div class="card-body">
                    @if($invoice->payment->payment_method === 'cash')
                    <div class="alert alert-warning mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Pembayaran Cash</h5>
                                <p class="mb-0">
                                    Pembayaran cash dilakukan saat kunjungan ke salon. Mohon datang tepat waktu sesuai jadwal booking yang telah ditentukan.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">From:</h6>
                            <div>
                                <strong>Twin Glow Salon</strong><br>
                                Jl. Dr.Manshyur No. 224<br>
                                Padang Bulan, 21414<br>
                                Email: info@TwinGlow.com<br>
                                Phone: +62 812-3456-7890
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="mb-3">To:</h6>
                            <div>
                                <strong>{{ $invoice->booking->nama }}</strong><br>
                                Email: {{ $invoice->booking->email }}<br>
                                Phone: {{ $invoice->booking->no_tlp }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">Invoice Details:</h6>
                            <div>
                                <strong>Invoice Number:</strong> {{ $invoice->invoice_number }}<br>
                                <strong>Issue Date:</strong> {{ Carbon\Carbon::parse($invoice->issue_date)->format('d F Y') }}<br>
                                <strong>Due Date:</strong> {{ Carbon\Carbon::parse($invoice->booking->tanggal)->format('d F Y') }}<br>
                                <strong>Status:</strong> 
                                <span class="badge bg-{{ $invoice->status === 'paid' ? 'success' : ($invoice->status === 'done' ? 'secondary' : 'warning') }}">
                                    {{ $invoice->status === 'sent' ? 'Done' : ucfirst($invoice->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $invoice->booking->jenis_layanan }}</td>
                                    <td>{{ Carbon\Carbon::parse($invoice->booking->tanggal)->format('d F Y') }}</td>
                                    <td>{{ $invoice->booking->waktu }}</td>
                                    <td class="text-end">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-end"><strong>Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-4">
                        <h6>Payment Information:</h6>
                        <div class="alert {{ $invoice->payment->payment_method === 'cash' ? 'alert-warning' : 'alert-info' }}">
                            <p class="mb-2">
                                <strong>Payment Method:</strong> {{ ucfirst($invoice->payment->payment_method) }}
                            </p>
                            @if($invoice->payment->payment_method === 'transfer')
                                <p class="mb-2">
                                    <strong>Bank:</strong> Bank Twin Glow<br>
                                    <strong>Account Number:</strong> 17283947261<br>
                                    <strong>Account Name:</strong> Twin Glow Salon Padang Bulan
                                </p>
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Penting:</strong> Mohon bawa bukti transfer saat kunjungan ke salon untuk verifikasi pembayaran.
                                </div>
                            @endif
                            <p class="mb-0">
                                <strong>Order Date:</strong> 
                                {{ $invoice->created_at ? Carbon\Carbon::parse($invoice->created_at)->setTimezone('Asia/Jakarta')->format('d F Y H:i') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <a href="/" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman Utama</a>
</div>
@endsection 