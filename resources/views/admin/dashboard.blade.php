@extends('layouts.dashboard-layout')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Welcome Admin 👋</h1>
        <p class="text-gray-600 mt-1">Here’s a snapshot of what's happening today.</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Cards (same as before) -->
        <div class="p-6 bg-white rounded-xl shadow flex items-center space-x-4">
            <div class="text-indigo-600 text-3xl">👥</div>
            <div>
                <h2 class="text-xl font-semibold">{{ $totalUsers }}</h2>
                <p class="text-gray-500">Total Users</p>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow flex items-center space-x-4">
            <div class="text-green-500 text-3xl">🛍️</div>
            <div>
                <h2 class="text-xl font-semibold">{{ $totalVendors }}</h2>
                <p class="text-gray-500">Vendors</p>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow flex items-center space-x-4">
            <div class="text-yellow-500 text-3xl">📦</div>
            <div>
                <h2 class="text-xl font-semibold">{{ $totalRentals }}</h2>
                <p class="text-gray-500">Items Listed</p>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow flex items-center space-x-4">
            <div class="text-pink-500 text-3xl">💰</div>
            <div>
                <h2 class="text-xl font-semibold">₹{{ number_format($totalEarnings) }}</h2>
                <p class="text-gray-500">Total Earnings</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Quick manage boxes (same as before) -->
        <div class="p-6 bg-white rounded-xl shadow">
            <h3 class="text-lg font-bold mb-4">Manage</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.manage-users') }}" class="block w-full text-center bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded transition">
                    Manage Users
                </a>
                <a href="{{ route('admin.manage-rentals') }}" class="block w-full text-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition">
                    Manage Rentals
                </a>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow">
            <h3 class="text-lg font-bold mb-4">Recent Activity</h3>
            <ul class="space-y-2 text-gray-700 text-sm">
                <li>✅ {{ $recentRentals[0]->vendor->name ?? 'Someone' }} added {{ $recentRentals[0]->title ?? '' }}</li>
                <li>📦 {{ $recentRentals[1]->vendor->name ?? 'Someone' }} listed a product</li>
                <li>🛒 New booking made today</li>
                <li>💸 Payment processed today</li>
            </ul>
        </div>
    </div>

    <!-- Recent Rentals -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <h3 class="text-lg font-bold mb-4">Recent Rentals</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 text-left font-semibold">Customer</th>
                        <th class="py-2 px-4 text-left font-semibold">Item</th>
                        <th class="py-2 px-4 text-left font-semibold">Rental Date</th>
                        <th class="py-2 px-4 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRentals as $rental)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $rental->vendor->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $rental->title }}</td>
                        <td class="py-2 px-4">{{ $rental->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">
                            @if($rental->status == 'completed')
                                <span class="text-green-500 font-semibold">Completed</span>
                            @elseif($rental->status == 'pending')
                                <span class="text-yellow-500 font-semibold">Pending</span>
                            @elseif($rental->status == 'cancelled')
                                <span class="text-red-500 font-semibold">Cancelled</span>
                            @else
                                <span class="text-gray-500 font-semibold">{{ ucfirst($rental->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="py-2 px-4" colspan="4" class="text-center">No rentals found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js Earnings Graph -->
    <div class="bg-white rounded-xl shadow p-6 mb-8 relative h-80"> <!-- ADD relative + fixed height -->
    <h3 class="text-lg font-bold mb-4">Monthly Earnings Overview</h3>

    <div class="absolute inset-0 p-10"> <!-- ADD this wrapper -->
        <canvas id="earningsChart" class="w-full h-full"></canvas> <!-- Make canvas take full inside -->
    </div>
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('earningsChart').getContext('2d');

  console.log("Month Names:", {!! json_encode($monthNames) !!}); // 🔥 Check data
  console.log("Final Earnings:", {!! json_encode($finalEarnings) !!}); // 🔥 Check data
  console.log(ctx); // 🔥 Check if ctx is coming

  const earningsChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: {!! json_encode($monthNames) !!},
          datasets: [{
              label: 'Monthly Earnings (INR)',
              data: {!! json_encode($finalEarnings) !!},
              borderColor: 'rgba(54, 162, 235, 1)',
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              fill: true,
              tension: 0.3,
              pointBackgroundColor: 'blue',
              pointRadius: 5
          }]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
              y: {
                  beginAtZero: true,
                  
              }
          }
      }
  });
</script>
@endpush


    <!-- Top Vendors -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <h3 class="text-lg font-bold mb-4">Top Vendors</h3>
        <ul class="space-y-3">
            @forelse($topVendors as $vendor)
            <li class="flex justify-between">
                <span>{{ $vendor->name }}</span>
                <span class="text-gray-500">{{ $vendor->rentals_count }} Items</span>
            </li>
            @empty
            <li>No vendors yet.</li>
            @endforelse
        </ul>
    </div>

    <!-- System Notifications -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <h3 class="text-lg font-bold mb-4">System Notifications</h3>
        <div class="space-y-3 text-sm text-gray-700">
            <div class="p-3 bg-yellow-100 rounded">
                ⚠️ Reminder: Vendor approval pending for 2 new vendors.
            </div>
            <div class="p-3 bg-green-100 rounded">
                ✅ Backup completed successfully today.
            </div>
            <div class="p-3 bg-red-100 rounded">
                ❗ Payment gateway maintenance scheduled for 30th April.
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm mt-8">
        &copy; {{ date('Y') }} RentHub. All rights reserved.
    </footer>
@endsection



