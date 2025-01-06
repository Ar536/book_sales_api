<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable =[ // fillable sudah bawaan utk model
        'name', 'account_number','image'
    ];
}
