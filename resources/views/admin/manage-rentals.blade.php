@extends('layouts.dashboard-layout')

@section('content')
<div class="min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-indigo-700">Manage Rentals</h1>
        <a href="#"
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
            ➕ Add New Rental
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" placeholder="Search rentals..."
               class="w-full p-3 rounded border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
    </div>

    <!-- Rentals Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-indigo-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Vendor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
    @foreach($rentals as $index => $rental)
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">{{ $index + 1 }}</td>
            <td class="px-6 py-4">{{ $rental->title }}</td>
            <td class="px-6 py-4">{{ $rental->vendor->name ?? 'N/A' }}</td>
            <td class="px-6 py-4">{{ $rental->category }}</td>
            <td class="px-6 py-4">₹{{ $rental->price }}/day</td>
            <td class="px-6 py-4">
                @if($rental->status == 'active')
                    <span class="inline-block px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                        Active
                    </span>
                @else
                    <span class="inline-block px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                        Inactive
                    </span>
                @endif
            </td>
            <td class="px-6 py-4 text-center space-x-2">
                <a href="#" class="text-blue-500 hover:text-blue-700">✏️ Edit</a>
                <a href="#" class="text-red-500 hover:text-red-700">🗑 Delete</a>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
    </div>
</div>
@endsection
