@extends('layouts.dashboard-layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">📦 My Rentals</h2>

        @if ($items->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Image</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Title</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Category</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Created At</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($items as $item)
                            @php
                                $images = json_decode($item->images, true);
                            @endphp
                            <tr>
                                <td class="px-6 py-4">
                                    @if (is_array($images) && count($images))
                                        <img src="{{ $images[0] }}" class="w-16 h-16 object-cover rounded" alt="Item Image">
                                    @else
                                        <span class="text-gray-400 italic">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $item->title }}</td>
                                <td class="px-6 py-4 capitalize">{{ $item->category }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'active')
                                        <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Active</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('vendor.items.edit', $item->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @else
            <p class="text-gray-600">You haven't posted any rental items yet.</p>
        @endif
    </div>
</div>
@endsection
