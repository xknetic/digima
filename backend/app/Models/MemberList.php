<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberList extends Model
{
    //
    use HasFactory;

    protected $table = 'member_lists';

    protected $guarded = [];

    // public function member_lists(){
    //     return $this->hasMany(MemberList::class, 'area', 'memberlistID');
    // }
}
