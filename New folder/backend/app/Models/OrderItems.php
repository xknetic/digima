<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'order_items';

    protected $primaryKey = 'order_items_id';

    protected $guarded = [];

    public function items(){
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}
