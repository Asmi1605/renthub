@extends('layouts.dashboard-layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow p-6">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">{{ $rental->title ?? 'Rental Item' }}</h1>
        <span class="inline-block mt-2 text-xs px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full">
            {{ $rental->category ?? 'Uncategorized' }}
        </span>
    </div>

    {{-- Image Carousel --}}
    @php
        $images = $rental->images ?? ($rental->image_url ? [$rental->image_url] : []);
        $fallbackImages = [
            'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=',
            'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=',
            'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ='
        ];
    @endphp

    <div class="mb-8">
        <div class="glide" id="rental-carousel">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @forelse($images as $image)
                        <li class="glide__slide">
                            <img src="{{ $image }}" 
                                 alt="Rental image" 
                                 class="w-full h-[400px] object-cover rounded-lg shadow" />
                        </li>
                    @empty
                        @foreach($fallbackImages as $fallback)
                            <li class="glide__slide">
                                <img src="{{ $fallback }}" 
                                     alt="Fallback image" 
                                     class="w-full h-[400px] object-cover rounded-lg shadow" />
                            </li>
                        @endforeach
                    @endforelse
                </ul>
            </div>

            {{-- Arrows --}}
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
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Pricing & Vendor</h2>
            <div class="mb-3">
                <span class="text-2xl font-bold text-indigo-600">
                    ₹{{ number_format($rental->price) }}
                </span>
                <span class="text-sm text-gray-500">/ day</span>
            </div>

            <p class="text-sm text-gray-600 mb-1">
                <strong>Vendor:</strong> {{ $rental->vendor->name ?? 'N/A' }}
            </p>
            <p class="text-sm text-gray-600">
                <strong>Contact:</strong> {{ $rental->vendor->contact ?? 'Not Available' }}
            </p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('user.items') }}"
           class="text-sm text-gray-600 hover:underline inline-flex items-center">
            ← Back to Listings
        </a>

        <a href="{{ route('user.items.book', $rental->id) }}"
           class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-3 rounded-lg transition-all">
            Book Now
        </a>
    </div>
</div>

{{-- Glide.js Assets --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
<script>
    new Glide('#rental-carousel', {
        type: 'carousel',
        perView: 1,
        gap: 10,
        autoplay: 5000
    }).mount();
</script>
@endpush
@endsection
