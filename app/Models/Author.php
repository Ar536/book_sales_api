<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable =[ // fillable sudah bawaan utk model
        'name', 'photo','bio'
    ];
}
