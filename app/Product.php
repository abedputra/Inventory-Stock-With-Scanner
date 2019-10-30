<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = 'products';

    protected $fillable = ['category_id','name','price','image','qty', 'barcode_id'];

    protected $hidden = ['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function barcode()
    {
        return $this->belongsTo(Barcode::class);
    }
}
