<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['payment_method', 'user_id', 'cart_id', 'state','order_total','tax','is_ordered'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }
}
