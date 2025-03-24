<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'product_categories';

    protected $guarded = [];

    public function product_categories(){
        return $this->belongsToMany(ProductCategory::class);
    }
}
