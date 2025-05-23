<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiverInfomation extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'receiver_infomations';

    protected $primaryKey = 'receiver_id';

    protected $guarded = [];
}
