<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'currencies';

    protected $primaryKey = 'currency_id';

    protected $guarded = [];
}
