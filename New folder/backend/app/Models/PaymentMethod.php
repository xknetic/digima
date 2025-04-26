<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'payment_methods';

    protected $primaryKey = 'payment_method_id';

    protected $guarded = [];
}
