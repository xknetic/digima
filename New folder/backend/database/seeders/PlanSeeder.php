<?php

namespace Database\Seeders;

use App\Models\MlmPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $plans = [
            [
                'mlm_plan_code' => 'Direct',
                'mlm_plan_trigger' => 'Slot Creation',
            ],
            [
                'mlm_plan_code' => 'Indirect',
                'mlm_plan_trigger' => 'Slot Creation',
            ],
        ];

        foreach($plans as $plans) {
            MlmPlan::create($plans);
        }
    }
}
