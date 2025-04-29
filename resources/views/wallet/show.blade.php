@extends('layouts.dashboard-layout')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Your Wallet</h1>
        <p class="text-gray-600 mt-1">Manage your funds securely here.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md space-y-6">
        <h2 class="text-xl font-semibold text-gray-800">Current Balance: ₹{{ number_format($wallet->balance, 2) }}</h2>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Add Funds Form -->
        <form action="{{ route('wallet.addFunds') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-600">Add Funds</label>
                <input type="number" name="amount" id="amount" class="mt-2 w-full p-3 rounded-lg border border-gray-300" placeholder="Amount to add" min="1" required />
            </div>
            <button type="submit" class="bg-indigo-600 text-white p-3 rounded-lg w-full hover:bg-indigo-700 transition duration-300">Add Funds</button>
        </form>

        <!-- Withdraw Funds Form -->
        <form action="{{ route('wallet.withdrawFunds') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="withdraw_amount" class="block text-sm font-medium text-gray-600">Withdraw Funds</label>
                <input type="number" name="amount" id="withdraw_amount" class="mt-2 w-full p-3 rounded-lg border border-gray-300" placeholder="Amount to withdraw" min="1" required />
            </div>
            <button type="submit" class="bg-red-600 text-white p-3 rounded-lg w-full hover:bg-red-700 transition duration-300">Withdraw Funds</button>
        </form>

        <!-- Transaction History -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800">Recent Transactions</h3>

            @if($transactions->isEmpty())
                <p class="text-gray-600 mt-2">No transactions yet.</p>
            @else
                <ul class="space-y-4 mt-4">
                    @foreach($transactions as $transaction)
                        <li class="flex justify-between items-center p-4 bg-gray-100 rounded-lg shadow-sm">
                            <div class="flex items-center space-x-4">
                                <span class="font-semibold text-gray-800">{{ ucfirst($transaction->type) }}</span>
                                <span class="text-gray-600 text-sm">{{ $transaction->created_at->diffForHumans() }}</span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-800">₹{{ number_format($transaction->amount, 2) }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
