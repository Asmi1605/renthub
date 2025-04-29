@extends('layouts.dashboard-layout')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Browse Items</h1>
    <p class="mt-1 text-gray-600">Find the perfect rentals tailored for you.</p>
</div>

@if($rentals->count())
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($rentals as $rental)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col">
            <img 
                src="{{ $rental->image_url ?? 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}" 
                alt="{{ $rental->title ?? 'Rental Image' }}" 
                class="w-full h-48 object-cover"
            >

            <div class="p-5 flex flex-col flex-1">
                <h2 class="text-lg font-bold text-gray-800 truncate">{{ $rental->title ?? 'Untitled' }}</h2>
                <p class="text-sm text-gray-500 mb-1">Category: {{ $rental->category ?? 'Uncategorized' }}</p>
                <p class="text-gray-700 font-bold text-base mb-4">
                    ₹{{ number_format($rental->price) }} <span class="text-sm text-gray-500">/ day</span>
                </p>

                <div class="mt-auto flex items-center justify-between">
                    <span class="text-xs text-gray-400 truncate max-w-[120px]">
                        Vendor: {{ $rental->vendor->name ?? 'N/A' }}
                    </span>

                    <a href="{{ route('user.items.details', $rental->id) }}" 
                       class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-all"
                       title="View details of {{ $rental->title }}">
                        View Details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Pagination --}}
@if(method_exists($rentals, 'links'))
    <div class="mt-8">
        {{ $rentals->links() }}
    </div>
@endif

@else
    <div class="text-center py-20">
        <h2 class="text-2xl font-semibold text-gray-800">No rentals available</h2>
        <p class="mt-2 text-gray-500">New items are added frequently. Please check back soon!</p>
    </div>
@endif
@endsection
