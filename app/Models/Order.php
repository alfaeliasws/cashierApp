<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'waiter',
        'description',
        'cashier',
        'item',
        'price',
        'item_amount',
        'status',
        'table_number'
    ];
}
