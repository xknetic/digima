<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipDirectIncome extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'membership_direct_incomes';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function memberships() {
        return $this->belongsTo(Membership::class, 'membership_id', 'membership_id');
    }

    public function membership_entries() {
        return $this->belongsTo(Membership::class, 'membership_entry_id', 'membership_id');
    }
}
