<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	public $timestamps = false;
    protected $fillable = ['name', 'address', 'email', 'logo', 'key_api'];
}
