@extends('layouts.dashboard-layout')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800">Booking Details</h1>

    <div class="mt-6">
        <h3 class="text-lg font-semibold">Rental Item: {{ $booking->rental->name }}</h3>
        <p>Start Date: {{ $booking->start_date }}</p>
        <p>End Date: {{ $booking->end_date }}</p>
        <p>Status: {{ ucfirst($booking->status) }}</p>
        <p>Total Price: ₹{{ $booking->total_price }}</p>
        <p>Payment Status: {{ ucfirst($booking->payment_status) }}</p>
    </div>
@endsection
