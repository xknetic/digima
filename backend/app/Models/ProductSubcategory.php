<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSubcategory extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'product_subcategories';

    protected $guarded = [];

    public function product_subcategories(){
        return $this->belongsToMany(ProductSubcategory::class);
    }

    public function product_categories(){
        return $this->belongsTo(ProductCategory::class);
    }
}
