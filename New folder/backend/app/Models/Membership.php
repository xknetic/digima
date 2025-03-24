<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'membership_id';

    protected $table = 'memberships';

    protected $guarded = [];

    public function memberships(){
        return $this->belongsTo(Membership::class);
    }
}
