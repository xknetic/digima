<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Code extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'codes';

    protected $primaryKey = 'code_id';

    protected $guarded = [];

    public function inventories(){
        return $this->belongsTo(Inventory::class, 'code_inventory_id', 'inventory_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'code_id', 'id');
    }
}
