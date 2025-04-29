@extends('layouts.dashboard-layout')

@section('content')
    <!-- Dashboard Overview Section -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-600 mt-1">Here's a quick overview of your rental activities.</p>
    </div>

    <!-- Quick Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Wallet Balance</h3>
            <div class="text-2xl font-bold text-gray-800">₹0.00</div>
            <a href="#" class="text-indigo-600 hover:text-indigo-800 mt-2 block">Add Funds / Withdraw</a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Upcoming Bookings</h3>
            <div class="text-2xl font-bold text-gray-800">{{ $upcomingCount }}</div>
            <a href="{{ route('user.bookings') }}" class="text-indigo-600 hover:text-indigo-800 mt-2 block">View All Bookings</a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Past Bookings</h3>
            <div class="text-2xl font-bold text-gray-800">{{ $completedCount }}</div>
            <a href="{{ route('user.bookings') }}" class="text-indigo-600 hover:text-indigo-800 mt-2 block">View All Bookings</a>
        </div>
    </div>

    <!-- Rental Items Search and Browse Section -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Browse Rental Items</h2>
        <div class="flex space-x-4 mb-4">
            <input type="text" placeholder="Search for items" class="w-full p-3 border border-gray-300 rounded-lg">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg">Search</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($rentals as $rental)
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg">
                    <img src="{{ $rental->image_url ?? 'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg' }}" alt="{{ $rental->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-lg font-semibold">{{ $rental->title }}</h3>
                    <p class="text-gray-600">₹{{ $rental->price }}/day</p>
                    <div class="mt-2 flex justify-between items-center">
                        <a href="{{ route('user.items.details', $rental->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Book Now</a>
                        <span class="{{ $rental->status === 'active' ? 'text-green-600' : 'text-red-500' }}">
    {{ $rental->status === 'active' ? 'Available' : 'Booked' }}
</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Booking Calendar Section -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Booking Calendar</h2>
        <div id="calendar"></div>
        {{-- Integrate FullCalendar JS here --}}
    </div>

    <!-- Recent Transactions Section -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Recent Transactions</h2>
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Transaction History</h3>
                <a href="{{ route('user.wallet') }}" class="text-indigo-600 hover:text-indigo-800">View All</a>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-semibold">Add Funds</h4>
                        <p class="text-gray-500 text-sm">₹2000 added to wallet</p>
                    </div>
                    <div class="text-green-600">+₹2000</div>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-semibold">Booking Payment</h4>
                        <p class="text-gray-500 text-sm">Rental for Item 1</p>
                    </div>
                    <div class="text-red-600">-₹500</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Refund System Section -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Refund Status</h2>
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600">You have no pending refunds.</p>
        </div>
    </div>
@endsection
