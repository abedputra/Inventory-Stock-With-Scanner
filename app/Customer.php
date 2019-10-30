<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address', 'email', 'phone'];

    protected $hidden = ['created_at', 'updated_at'];
}
