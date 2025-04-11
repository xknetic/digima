<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'carts';

    protected $primaryKey = 'cart_id';

    protected $guarded = [];

    public function inventories(){
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }

    public function slots(){
        return $this->belongsTo(Slot::class, 'slot_id', 'slot_id');
    }
}
