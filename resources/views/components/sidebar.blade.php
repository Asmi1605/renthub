@php
    $role = auth()->user()->role ?? 'user';
@endphp

<div class="px-6">
    <ul class="space-y-4">

        <!-- Common for All Roles -->
        <!-- <li>
            <a href="{{ route('redirect') }}"
               class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                🏠 <span class="ml-3">Home</span>
            </a>
        </li> -->

      

        @if($role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                    🛡 <span class="ml-3">Admin Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manage-users') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                    📋 <span class="ml-3">Manage Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manage-rentals') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                    🛒 <span class="ml-3">Manage Rentals</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manage-vendors') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                   🛍 <span class="ml-3">Manage Vendors</span>
                </a>
            </li>
        @elseif($role === 'vendor')
            <li>
                <a href="{{ route('vendor.dashboard') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                    🛍 <span class="ml-3">Vendor Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('vendor.items.create') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                    ➕ <span class="ml-3">Add New Rental</span>
                </a>
            </li>
            <li>
                <a href="{{ route('vendor.items.rentals') }}"
                   class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
                    📦 <span class="ml-3">My Rentals</span>
                </a>
            </li>
            @elseif($role === 'user')
    <li>
        <a href="{{ route('user.dashboard') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            👤 <span class="ml-3">User Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('user.bookings') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            📅 <span class="ml-3">My Bookings</span>
        </a>
    </li>
    
    <li>
        <a href="{{ route('user.items') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            📦 <span class="ml-3">Items</span>
        </a>
    </li>
    <!-- <li>
        <a href="{{ route('user.items.category') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            🗂️ <span class="ml-3">Items by Category</span>
        </a>
    </li> -->
    <li>
        <a href="{{ route('wallet.show') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            💳 <span class="ml-3">Wallet</span>
        </a>
    </li>
    <!-- <li>
        <a href="{{ route('user.reviews') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            ⭐ <span class="ml-3">Ratings & Reviews</span>
        </a>
    </li> -->
    <!-- <li>
        <a href="{{ route('user.refunds') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            🔄 <span class="ml-3">Refunds & Cancellations</span>
        </a>
    </li> -->
    <li>
        <a href="{{ route('notifications') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            🔔 <span class="ml-3">Notifications</span>
        </a>
    </li>
    <!-- <li>
        <a href="{{ route('user.settings') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            ⚙️ <span class="ml-3">Settings</span>
        </a>
    </li> -->
    <li>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center p-2 text-gray-700 rounded hover:bg-indigo-100 transition">
            👤 <span class="ml-3">Profile</span>
        </a>
    </li>
@endif


        <!-- Common Logout -->
        <li class="mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center p-2 text-gray-700 rounded hover:bg-red-100 transition">
                    🚪 <span class="ml-3">Logout</span>
                </button>
            </form>
        </li>

    </ul>
</div>
