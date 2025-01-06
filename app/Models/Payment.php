<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[ // fillable sudah bawaan utk model
        'order_id', 'payment_method_id','amount','status','staff_confirmed_by','staff_confirmed_at'
    ];
}
