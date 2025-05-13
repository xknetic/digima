<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MlmPlanLabel extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $table = 'mlm_plan_labels';

    protected $primaryKey = 'label_id';

    protected $guarded = [];

    public function mlm_plans(){
        return $this->belongsTo(MlmPlan::class, 'mlm_plan_id', 'mlm_plan_id');
    }
}
