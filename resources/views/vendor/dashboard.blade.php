@extends('layouts.dashboard-layout')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- Welcome Heading --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">👋 Welcome, {{ Auth::user()->name }}</h2>
        <p class="text-gray-500 mt-1">Here’s a quick overview of your rental activity.</p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Items -->
        <div class="bg-blue-600 text-white rounded-xl shadow p-5">
            <div class="flex items-center space-x-4">
                <div class="text-3xl"><i class="bi bi-box"></i></div>
                <div>
                    <p class="text-sm uppercase">Total Items</p>
                    <p class="text-2xl font-semibold">{{ $totalItems }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="bg-yellow-500 text-white rounded-xl shadow p-5">
            <div class="flex items-center space-x-4">
                <div class="text-3xl"><i class="bi bi-clock"></i></div>
                <div>
                    <p class="text-sm uppercase">Pending Bookings</p>
                    <p class="text-2xl font-semibold">{{ $pendingBookings }}</p>
                </div>
            </div>
        </div>

        <!-- Monthly Earnings -->
        <div class="bg-green-500 text-white rounded-xl shadow p-5">
            <div class="flex items-center space-x-4">
                <div class="text-3xl"><i class="bi bi-currency-rupee"></i></div>
                <div>
                    <p class="text-sm uppercase">This Month's Earnings</p>
                    <p class="text-2xl font-semibold">₹{{ $monthlyEarnings }}</p>
                </div>
            </div>
        </div>

        <!-- Wallet Balance -->
        <div class="bg-gray-800 text-white rounded-xl shadow p-5">
            <div class="flex items-center space-x-4">
                <div class="text-3xl"><i class="bi bi-wallet2"></i></div>
                <div>
                    <p class="text-sm uppercase">Wallet Balance</p>
                    <p class="text-2xl font-semibold">₹{{ $wallet }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="flex flex-wrap gap-4 mb-10">
        <a href="{{ route('vendor.items.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
            ➕ Add New Item
        </a>
        <a href="{{ route('vendor.bookings') }}" class="bg-gray-700 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-800 transition">
            🧾 View Bookings
        </a>
        <a href="{{ route('vendor.withdraw') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition">
            💸 Request Withdrawal
        </a>
    </div>

    {{-- Recent Activity --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recent Bookings -->
        <div>
            <h3 class="text-xl font-semibold mb-4">🕒 Recent Bookings</h3>
            <div class="bg-white shadow rounded-lg divide-y divide-gray-100">
                @forelse($recentBookings as $booking)
                <div class="px-5 py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $booking->rental->title }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($booking->status) }}</p>
                    </div>
                    <span class="text-sm text-gray-400">{{ $booking->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <div class="px-5 py-4 text-gray-400">No recent bookings.</div>
                @endforelse
            </div>
        </div>

        <!-- Recently Added Items -->
        <div>
            <h3 class="text-xl font-semibold mb-4">🆕 Recently Added Items</h3>
            <div class="bg-white shadow rounded-lg divide-y divide-gray-100">
                @forelse($recentItems as $item)
                <div class="px-5 py-4 flex justify-between items-center">
                    <p class="font-medium">{{ $item->title }}</p>
                    <span class="text-sm text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <div class="px-5 py-4 text-gray-400">No recent items.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
