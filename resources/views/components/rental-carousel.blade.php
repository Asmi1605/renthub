<!-- components/rental-carousel.blade.php -->
<div class="mb-10" data-aos="zoom-in">
    <div class="glide" id="rental-carousel">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @forelse($images as $image)
                    <li class="glide__slide">
                        <img src="{{ $image }}" alt="Rental image"
                             class="w-full h-[400px] object-cover rounded-lg shadow" />
                    </li>
                @empty
                    @foreach($fallbackImages as $fallback)
                        <li class="glide__slide">
                            <img src="{{ $fallback }}" alt="Fallback image"
                                 class="w-full h-[400px] object-cover rounded-lg shadow" />
                        </li>
                    @endforeach
                @endforelse
            </ul>
        </div>

        {{-- Carousel Arrows --}}
        <div class="glide__arrows mt-3 flex justify-center gap-4" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left bg-gray-100 px-3 py-1 rounded hover:bg-gray-200" data-glide-dir="<">‹</button>
            <button class="glide__arrow glide__arrow--right bg-gray-100 px-3 py-1 rounded hover:bg-gray-200" data-glide-dir=">">›</button>
        </div>
    </div>
</div>

{{-- Scripts for Glide.js --}}
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
