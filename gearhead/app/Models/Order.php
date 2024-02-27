<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quantity',
        'total_amount',
        'payment_method',
        'status',
        'product_names',
        'product_images',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
