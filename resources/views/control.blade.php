@extends('layouts.admin')

@section('title', 'Control - All Bookings')

@section('content')
<div class="container mt-4">
    <h2>All Bookings (Control Page)</h2>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name ?? '-' }}</td>
                    <td>{{ $booking->user->email ?? '-' }}</td>
                    <td>{{ $booking->service_id->name ?? '-' }}</td>
                    <td>{{ number_format($booking->service->price ?? 0) }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->time }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 