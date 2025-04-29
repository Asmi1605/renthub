@extends('layouts.dashboard-layout')


@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="bg-green-100 border border-green-300 p-6 rounded-xl text-center">
        <h2 class="text-2xl font-bold text-green-800 mb-4">Booking Confirmed!</h2>

        <p class="text-gray-700">Thank you! Your booking has been confirmed.</p>

        <div class="mt-6 text-left space-y-2">
            <p><strong>Rental:</strong> {{ $booking->rental->title }}</p>
            <p><strong>From:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->toFormattedDateString() }}</p>
            <p><strong>To:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->toFormattedDateString() }}</p>
            <p><strong>Total Price:</strong> ₹{{ $booking->total_price }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('user.dashboard') }}"
                class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-xl hover:bg-indigo-700">
                Go to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
