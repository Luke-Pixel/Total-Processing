<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model for payments 
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'refrence',
        'timestamp',
        'refunded',
        'payment_id'
        
    ];

}
