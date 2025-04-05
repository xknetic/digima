<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'items';

    protected $primaryKey = 'item_id';

    protected $guarded = [];
    
    public function memberships(){
        return $this->belongsTo(Membership::class, 'membership_id', 'membership_id');
    }
}
