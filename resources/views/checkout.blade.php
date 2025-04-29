@extends('layouts.dashboard-layout')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Confirm Your Booking</h2>

    <div class="bg-white shadow p-6 rounded-xl space-y-6">
        <div>
            <h3 class="text-xl font-bold">{{ $rental->title }}</h3>
            <p class="text-gray-600 text-sm">Hosted by: {{ $rental->user->name ?? 'Vendor' }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">From:</p>
                <p class="text-lg">{{ $startDate?->toFormattedDateString() ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">To:</p>
                <p class="text-lg">{{ $endDate?->toFormattedDateString() ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Duration:</p>
                <p class="text-lg">{{ $days }} day(s)</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Price/Day:</p>
                <p class="text-lg">₹{{ $rental->price }}</p>
            </div>
        </div>

        <div class="border-t pt-4">
            <p class="text-xl font-bold">Total: ₹{{ $totalPrice }}</p>
        </div>

        @if ($days > 0 && $totalPrice > 0)
        <form method="POST" action="{{ route('booking.store') }}">
            @csrf
            <input type="hidden" name="rental_id" value="{{ $rental->id }}">
            <input type="hidden" name="from" value="{{ $startDate }}">
            <input type="hidden" name="to" value="{{ $endDate }}">
            <input type="hidden" name="price" value="{{ $totalPrice }}">

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-xl font-semibold">
                Confirm Booking
            </button>
        </form>
        @else
        <p class="text-red-600 text-sm">Invalid or missing date range. Please go back and select a valid range.</p>
        @endif
    </div>
</div>
@endsection
