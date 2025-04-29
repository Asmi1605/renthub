@extends('layouts.dashboard-layout')

@section('content')
    <!-- Notification Page Title -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Your Notifications</h1>
        <p class="text-gray-600 mt-1">Stay up to date with your latest activities.</p>
    </div>

    <!-- Notification List -->
    <div class="space-y-4">
        <!-- Notification Item 1 -->
        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 bg-white flex justify-between items-center hover:scale-105 transform ease-in-out">
            <div class="flex items-center space-x-4">
                <div class="bg-indigo-600 p-3 rounded-full text-white">
                    <i class="fas fa-bell"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg text-gray-800">New Booking Request</h3>
                    <p class="text-gray-600 text-sm">You have received a new booking request for Item 1.</p>
                    <span class="text-xs text-gray-400">2 hours ago</span>
                </div>
            </div>
            <button class="text-indigo-600 hover:text-indigo-800 text-sm transition-all duration-300 transform hover:scale-105" onclick="markAsRead(this)">Mark as Read</button>
        </div>

        <!-- Notification Item 2 (already read) -->
        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 bg-gray-100 flex justify-between items-center hover:scale-105 transform ease-in-out">
            <div class="flex items-center space-x-4">
                <div class="bg-green-600 p-3 rounded-full text-white">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg text-gray-800">Booking Confirmed</h3>
                    <p class="text-gray-600 text-sm">Your booking for Rental Item 2 has been confirmed.</p>
                    <span class="text-xs text-gray-400">1 day ago</span>
                </div>
            </div>
            <button class="text-indigo-600 hover:text-indigo-800 text-sm transition-all duration-300 transform hover:scale-105" onclick="markAsRead(this)">Read</button>
        </div>

        <!-- Notification Item 3 -->
        <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 bg-white flex justify-between items-center hover:scale-105 transform ease-in-out">
            <div class="flex items-center space-x-4">
                <div class="bg-red-600 p-3 rounded-full text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg text-gray-800">Booking Canceled</h3>
                    <p class="text-gray-600 text-sm">The booking for Rental Item 3 has been canceled.</p>
                    <span class="text-xs text-gray-400">3 days ago</span>
                </div>
            </div>
            <button class="text-indigo-600 hover:text-indigo-800 text-sm transition-all duration-300 transform hover:scale-105" onclick="markAsRead(this)">Mark as Read</button>
        </div>

        <!-- Fallback message when no notifications are present -->
        <div id="no-notifications" class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex justify-center items-center space-x-4">
            <div class="text-center">
                <i class="fas fa-bell-slash text-4xl text-gray-400"></i>
                <p class="text-gray-600 mt-2 text-lg">No Notifications Yet</p>
                <p class="text-gray-400 mt-1">You're all caught up!</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Simulate marking a notification as read
        function markAsRead(button) {
            const notificationItem = button.closest('div');
            notificationItem.classList.add('bg-gray-100');  // Mark as read by changing background
            button.innerText = 'Read';  // Change button text to 'Read'
            button.disabled = true;  // Disable the button after marking
            // You can also add an animation here for extra feedback, like a fade-out effect
        }

        // Simulate showing/hiding the "No Notifications" message
        window.addEventListener('load', function () {
            const notifications = document.querySelectorAll('.bg-white');
            const noNotificationsMessage = document.getElementById('no-notifications');
            
            // If there are no notifications, show the fallback message
            if (notifications.length === 0) {
                noNotificationsMessage.classList.remove('hidden');
            } else {
                noNotificationsMessage.classList.add('hidden');
            }
        });
    </script>
@endsection
