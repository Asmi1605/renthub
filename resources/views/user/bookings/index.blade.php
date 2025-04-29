@extends('layouts.dashboard-layout')

@section('content')
<div class="space-y-16">

    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
            My Bookings
        </h1>
        <p class="text-gray-400 mt-3 text-lg">Track and manage your amazing experiences ✨</p>
    </div>

    @php
        $sections = [
            ['title' => 'Upcoming Bookings', 'from' => 'from-blue-500', 'to' => 'to-indigo-500', 'bookings' => $upcomingBookings],
            ['title' => 'Completed Bookings', 'from' => 'from-green-400', 'to' => 'to-emerald-500', 'bookings' => $completedBookings],
            ['title' => 'Canceled Bookings', 'from' => 'from-red-400', 'to' => 'to-pink-500', 'bookings' => $canceledBookings],
        ];
    @endphp

    @foreach($sections as $section)
    <section class="space-y-8">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r {{ $section['from'] }} {{ $section['to'] }}">
            {{ $section['title'] }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($section['bookings'] as $booking)
                <div class="relative group rounded-2xl overflow-hidden shadow-2xl hover:scale-105 transform transition duration-300">
                    
                    <!-- Colorful gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-br {{ $section['from'] }} {{ $section['to'] }}"></div>

                    <!-- Glassmorphism white blur layer -->
                    <div class="absolute inset-0 bg-white/20 backdrop-blur-md"></div>

                    <!-- Content -->
                    <div class="relative z-10 p-6 space-y-4 text-white">
                        <h3 class="text-xl font-bold">{{ $booking->rental->title ?? 'N/A' }}</h3>

                        <div class="text-sm space-y-1">
                            <p>🏷️ Category: <span class="font-semibold">{{ $booking->rental->category ?? 'N/A' }}</span></p>
                            <p>📅 {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} → {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                            <p>💵 ₹{{ number_format($booking->total_price, 2) }}</p>
                        </div>

                        <div class="mt-4">
                            <span class="inline-flex items-center px-4 py-1 text-sm font-semibold rounded-full bg-white/20 backdrop-blur-lg">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>

                </div>
            @empty
                <p class="text-gray-400">No {{ strtolower(str_replace('Bookings', '', $section['title'])) }} found.</p>
            @endforelse
        </div>
    </section>
    @endforeach

</div>
@endsection
