@extends('layouts.dashboard-layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow p-6">

    {{-- Header --}}
    <div class="mb-4 flex justify-between items-start flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">{{ $rental->title ?? 'Rental Item' }}</h1>
            <div class="flex items-center gap-2 mt-2 flex-wrap">
                @if(!empty($rental->category))
                    <span class="text-xs px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full">{{ $rental->category }}</span>
                @endif

                @if(!empty($rental->tags))
                    @foreach(json_decode($rental->tags, true) ?? [] as $tag)
                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded-full">{{ $tag }}</span>
                    @endforeach
                @endif

                <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">
                    {{ $rental->status === 'active' ? 'Available' : 'Unavailable' }}
                </span>
            </div>
        </div>

        <div class="flex items-center gap-2 mt-2">
            {{-- Wishlist Button --}}
            <button title="Add to Wishlist"
                class="p-2 bg-white rounded-full shadow hover:bg-red-50 border border-gray-200 text-red-500 hover:text-red-600 transition z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </button>

            {{-- Share Button --}}
            <button title="Share Rental"
                onclick="navigator.share({ title: '{{ $rental->title ?? 'Rental' }}', url: window.location.href })"
                class="p-2 bg-white rounded-full shadow hover:bg-indigo-50 border border-gray-200 text-indigo-500 hover:text-indigo-600 transition z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 12v1.5a2.5 2.5 0 002.5 2.5h11a2.5 2.5 0 002.5-2.5V12m-7-5v10m0-10l-3 3m3-3l3 3" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Image Carousel --}}
    <div class="mb-8">
        <div class="glide" id="rental-carousel">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                @php
    $images = json_decode($rental->images, true) ?? [];
    $fallbackImage = 'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg';
@endphp

@forelse($images as $img)
    <li class="glide__slide">
        <img 
            src="{{ $img }}" 
            alt="Rental image" 
            onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
            class="w-full h-[400px] object-cover rounded-lg shadow hover:scale-105 transition-transform duration-300" 
        />
    </li>
@empty
    <li class="glide__slide">
        <img 
            src="{{ $fallbackImage }}" 
            alt="Fallback image" 
            class="w-full h-[400px] object-cover rounded-lg shadow" 
        />
    </li>
@endforelse

                </ul>
            </div>
            <div class="glide__arrows mt-3 flex justify-center gap-4" data-glide-el="controls">
                <button class="glide__arrow glide__arrow--left bg-gray-100 px-3 py-1 rounded hover:bg-gray-200" data-glide-dir="<">‹</button>
                <button class="glide__arrow glide__arrow--right bg-gray-100 px-3 py-1 rounded hover:bg-gray-200" data-glide-dir=">">›</button>
            </div>
        </div>
    </div>

    {{-- Rental Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Description</h2>
            <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                {{ $rental->description ?? 'No description provided.' }}
            </p>
        </div>

        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Pricing</h2>
            <div class="mb-3">
                <span class="text-2xl font-bold text-indigo-600">₹{{ number_format($rental->price ?? 0, 2) }}</span>
                <span class="text-sm text-gray-500">/ day</span>
            </div>
            <div class="flex items-center gap-3 mt-4">
                @php
                    $vendor = $rental->vendor ?? null;
                @endphp
                <img src="https://i.pravatar.cc/100?u={{ $vendor->id ?? '1' }}" class="w-12 h-12 rounded-full" />
                <div>
                    <h4 class="font-semibold text-sm text-gray-800">{{ $vendor->name ?? 'Vendor Name' }}</h4>
                    <p class="text-xs text-gray-500">Joined {{ $vendor->created_at?->format('M Y') ?? 'N/A' }} · {{ $vendor->rentals->count() ?? 0 }} listings</p>
                </div>
            </div>
            <div class="mt-4">
                <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">Select Rental Dates</label>
                <input type="text" id="availability" class="w-full border rounded px-3 py-2" placeholder="Select date range" />
            </div>
        </div>
    </div>

    {{-- Reviews (Fallback hardcoded for now) --}}
    <div class="mt-12 border-t pt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Customer Reviews</h2>

        @php
        // If actual reviews integration is pending, fallback to dummy data
        $reviews = [
            ['name' => 'Ravi Kumar', 'date' => '2 days ago', 'stars' => 4, 'text' => 'Great condition and very responsive vendor. Would rent again!'],
            ['name' => 'Sneha Mehra', 'date' => '1 week ago', 'stars' => 5, 'text' => 'Awesome experience. Delivered on time. 5 stars!']
        ];
        @endphp

        @foreach($reviews as $review)
        <div class="mb-4">
            <div class="flex items-center justify-between">
                <strong class="text-gray-700">{{ $review['name'] }}</strong>
                <span class="text-xs text-gray-400">{{ $review['date'] }}</span>
            </div>
            <div class="flex items-center gap-1 mt-1 mb-1">
                @for($i = 0; $i < 5; $i++)
                <svg class="w-4 h-4 {{ $i < $review['stars'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.179 3.617a1 1 0 00.95.69h3.801c.969 0 1.371 1.24.588 1.81l-3.076 2.23a1 1 0 00-.364 1.118l1.18 3.617c.3.921-.755 1.688-1.538 1.118l-3.076-2.23a1 1 0 00-1.175 0l-3.076 2.23c-.783.57-1.838-.197-1.538-1.118l1.18-3.617a1 1 0 00-.364-1.118l-3.076-2.23c-.783-.57-.38-1.81.588-1.81h3.801a1 1 0 00.95-.69l1.18-3.617z" />
                </svg>
                @endfor
            </div>
            <p class="text-gray-600 text-sm">{{ $review['text'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Actions --}}
    <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="#" class="text-sm text-gray-600 hover:underline inline-flex items-center">← Back to Listings</a>

        <button id="bookNowBtn"
    class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-3 rounded-lg transition-all">
    Book Now
</button>

    </div>
</div>

{{-- Glide.js --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    new Glide('#rental-carousel', {
        type: 'carousel',
        perView: 1,
        gap: 10,
        autoplay: 5000
    }).mount();

    flatpickr("#availability", {
        mode: "range",
        minDate: "today"
    });

    document.getElementById('bookNowBtn').addEventListener('click', function () {
    const dateRange = document.getElementById('availability').value;

    if (!dateRange) {
        alert('Please select a rental date range first.');
        return;
    }

    const rentalId = "{{ $rental->id }}";
    const url = new URL("{{ route('checkout', ':id') }}".replace(':id', rentalId), window.location.origin);
    url.searchParams.set('dates', dateRange);

    window.location.href = url.toString();
});
</script>
@endpush
@endsection
