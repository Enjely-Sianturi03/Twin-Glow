@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #222; }
        .header { background: #007bff; color: #fff; padding: 10px 20px; }
        .title { font-size: 22px; font-weight: bold; margin-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background: #f2f2f2; }
        .text-end { text-align: right; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 5px; color: #fff; font-size: 12px; }
        .bg-success { background: #28a745; }
        .bg-warning { background: #ffc107; color: #222; }
        .bg-info { background: #17a2b8; }
        .bg-primary { background: #007bff; }
        .alert { padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; }
        .alert-warning { background: #fff3cd; color: #856404; }
        .alert-info { background: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <h1>Invoice PDF</h1>
    <p>Ini adalah template invoice PDF dummy. Silakan sesuaikan sesuai kebutuhan.</p>
    <div class="header">
        <span class="title">Invoice</span>
    </div>
    <div class="section">
        <div style="width: 50%; float: left;">
            <h4>From:</h4>
            <div>
                <strong>Twin Glow Salon</strong><br>
                Jl. Dr.Manshyur No. 224<br>
                Padang Bulan, 21414<br>
                Email: info@TwinGlow.com<br>
                Phone: +62 812-3456-7890
            </div>
        </div>
        <div style="width: 50%; float: right;">
            <h4>To:</h4>
            <div>
                <strong>{{ $invoice->booking->nama }}</strong><br>
                Email: {{ $invoice->booking->email }}<br>
                Phone: {{ $invoice->booking->no_tlp }}
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="section">
        <h4>Invoice Details:</h4>
        <div>
            <strong>Invoice Number:</strong> {{ $invoice->invoice_number }}<br>
            <strong>Issue Date:</strong> {{ Carbon::parse($invoice->issue_date)->format('d F Y') }}<br>
            <strong>Due Date:</strong> {{ Carbon::parse($invoice->booking->tanggal)->format('d F Y') }}<br>
            <strong>Status:</strong>
            <span class="badge bg-{{ $invoice->status === 'paid' ? 'success' : ($invoice->status === 'done' ? 'secondary' : 'warning') }}">
                {{ $invoice->status === 'sent' ? 'Done' : ucfirst($invoice->status) }}
            </span>
        </div>
    </div>
    <div class="section">
        <table class="table">
            <thead>
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
                    <td>{{ Carbon::parse($invoice->booking->tanggal)->format('d F Y') }}</td>
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
    <div class="section">
        <h4>Payment Information:</h4>
        <div class="alert {{ $invoice->payment->payment_method === 'cash' ? 'alert-warning' : 'alert-info' }}">
            <p><strong>Payment Method:</strong> {{ ucfirst($invoice->payment->payment_method) }}</p>
            @if($invoice->payment->payment_method === 'transfer')
                <p><strong>Bank:</strong> Bank Twin Glow<br>
                <strong>Account Number:</strong> 17283947261<br>
                <strong>Account Name:</strong> Twin Glow Salon Padang Bulan</p>
            @endif
            <p><strong>Order Date:</strong> {{ $invoice->created_at ? Carbon::parse($invoice->created_at)->setTimezone('Asia/Jakarta')->format('d F Y H:i') : 'N/A' }}</p>
        </div>
    </div>
</body>
</html> 