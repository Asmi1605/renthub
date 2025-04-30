@extends('layouts.dashboard-layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">📦 Edit Rental Item</h2>

        <form action="{{ route('vendor.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $item->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $item->category) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Images -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700">Images</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <div class="mt-2">
                        @if ($item->images)
                            @php
                                $images = json_decode($item->images, true);
                            @endphp
                            @foreach ($images as $image)
                                <img src="{{ $image }}" class="w-20 h-20 object-cover rounded-md mt-2" alt="Image Preview">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Item</button>
            </div>
        </form>
    </div>
</div>
@endsection
