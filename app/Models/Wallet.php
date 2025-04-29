<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance'];

    // One wallet belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A wallet has many transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Add funds to the wallet
    public function addFunds($amount)
    {
        $this->balance += $amount;
        $this->save();

        // Create a transaction for this deposit
        $this->transactions()->create([
            'type' => 'deposit',
            'amount' => $amount,
            'description' => 'Funds added to wallet',
        ]);
    }

    // Withdraw funds from the wallet
    public function withdrawFunds($amount)
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->save();

            // Create a transaction for this withdrawal
            $this->transactions()->create([
                'type' => 'withdrawal',
                'amount' => $amount,
                'description' => 'Funds withdrawn from wallet',
            ]);

            return true;
        }

        return false;
    }
}
