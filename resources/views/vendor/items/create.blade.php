@extends('layouts.dashboard-layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-xl p-5">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">🛠️ Add New Rental Item</h2>

        <form action="{{ route('vendor.items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                <select id="category" name="category" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                    <option value="house">House</option>
                    <option value="electronics">Electronics</option>
                </select>
                @error('category') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma separated)</label>
                <input type="text" id="tags" name="tags" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('tags') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Pricing -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="price_day" class="block text-sm font-medium text-gray-700">Price/Day <span class="text-red-500">*</span></label>
                    <input type="number" id="price_day" name="price_day" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('price_day') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price_week" class="block text-sm font-medium text-gray-700">Price/Week</label>
                    <input type="number" id="price_week" name="price_week" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('price_week') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price_month" class="block text-sm font-medium text-gray-700">Price/Month</label>
                    <input type="number" id="price_month" name="price_month" class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('price_month') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

         <!-- Images Upload with Preview and Delete -->
<div x-data="{
        files: [],
        handleFiles(event) {
            this.files = Array.from(event.target.files);
        },
        removeFile(index) {
            this.files.splice(index, 1);
            // Clear the file input if no files left
            if (this.files.length === 0) {
                $refs.imageInput.value = '';
            }
        }
    }" class="space-y-4">

    <label for="images" class="block text-sm font-medium text-gray-700">Upload Images</label>

    <input
        type="file"
        id="images"
        name="images[]"
        multiple
        x-ref="imageInput"
        @change="handleFiles"
        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
    >

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" x-show="files.length > 0">
        <template x-for="(file, index) in files" :key="index">
            <div class="relative group rounded overflow-hidden border p-1 bg-gray-50 shadow">
                <img :src="URL.createObjectURL(file)" class="w-full h-28 object-cover rounded">

                <!-- Remove Button -->
                <button type="button"
                    @click="removeFile(index)"
                    title="Remove image"
                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 shadow-md hover:bg-red-700 transition">
                    &times;
                </button>
            </div>
        </template>
    </div>

    @error('images.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
</div>



            <!-- Submit -->
            <div class="pt-4 text-right">
                <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
 
</script>
@endpush
