<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'vendor_id',
        'category',
        'price',
        'status',
        'description',
        'images',
        'tags',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
    ];
    
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
