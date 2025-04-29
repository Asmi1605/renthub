<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show()
    {
        // Get the current user's wallet
        $wallet = Wallet::where('user_id', Auth::id())->first();

        // If the user doesn't have a wallet, create one
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => Auth::id(),
                'balance' => 0,
            ]);
        }

        // Fetch the latest 5 transactions for the wallet
        $transactions = $wallet->transactions()->latest()->take(5)->get();

        return view('wallet.show', compact('wallet', 'transactions'));
    }

    public function addFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->first();

        // Add funds to wallet
        $wallet->addFunds($request->amount);

        return redirect()->route('wallet.show')->with('success', 'Funds added successfully!');
    }

    public function withdrawFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->first();

        if ($wallet->withdrawFunds($request->amount)) {
            return redirect()->route('wallet.show')->with('success', 'Funds withdrawn successfully!');
        }

        return redirect()->route('wallet.show')->with('error', 'Insufficient funds!');
    }
}
