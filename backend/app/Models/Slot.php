<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'slots';

    protected $guarded = [];

    public function sponsor_info(){
        return $this->belongsTo(Slot::class, 'slot_sponsor', 'slot_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'slot_user_id', 'id');
    }

    public function memberships(){
        return $this->belongsTo(Membership::class, 'slot_membership_id', 'membership_id');
    }
}