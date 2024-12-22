<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'address', 'email', 'phone', 'method', 'notes','cart_id'];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

}
