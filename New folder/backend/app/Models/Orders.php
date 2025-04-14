<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $guarded = [];

    public function items(){
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}
