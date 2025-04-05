<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'inventories';

    protected $primaryKey = 'inventory_id';

    protected $guarded = [];

    public function branches(){
        return $this->belongsTo(Branch::class, 'inventory_branch_id', 'branch_id');
    }

    public function items(){
        return $this->belongsTo(Item::class, 'inventory_item_id', 'item_id');
    }
}
