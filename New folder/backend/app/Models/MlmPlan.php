<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MlmPlan extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'mlm_plans';

    protected $primaryKey = 'mlm_plan_id';

    protected $guarded = [];
}
