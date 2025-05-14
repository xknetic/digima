<?php

namespace Database\Seeders;

use App\Models\MlmPlan;
use App\Models\MlmPlanLabel;
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
                'mlm_genealogy_type' => 'Unilevel',
                'labels' => [
                    ['plan_code' => 'DIRECT', 'plan_name' => 'Direct Referral Bonus'],
                ],
            ],
            [
                'mlm_plan_code' => 'Indirect',
                'mlm_plan_trigger' => 'Slot Creation',
                'mlm_genealogy_type' => 'Unilevel',
                'labels' => [
                    ['plan_code' => 'INDIRECT', 'plan_name' => 'Indirect Referral Bonus'],
                ],
            ],
            [
                'mlm_plan_code' => 'Unilevel',
                'mlm_plan_trigger' => 'Product Repurchase',
                'mlm_genealogy_type' => 'Unilevel',
                'labels' => [
                    ['plan_code' => 'UNILEVEL', 'plan_name' => 'Unilevel Bonus'],
                ],
            ],
            [
                'mlm_plan_code' => 'Stair Step',
                'mlm_plan_trigger' => 'Product Repurchase',
                'mlm_genealogy_type' => 'Unilevel',
                'labels' => [
                    ['plan_code' => 'STAIRSTEP', 'plan_name' => 'Stair Step'],
                ],
            ],
            [
                'mlm_plan_code' => 'Binary',
                'mlm_plan_trigger' => 'Slot Placement',
                'mlm_genealogy_type' => 'Binary',
                'labels' => [
                    ['plan_code' => 'BINARY', 'plan_name' => 'BINARY'],
                ]
            ],
        ];

        // Insert MLM plans and their associated labels
        foreach ($plans as $planData) {
            $plan = MlmPlan::create([
                'mlm_plan_code' => $planData['mlm_plan_code'],
                'mlm_plan_trigger' => $planData['mlm_plan_trigger'],
                'mlm_genealogy_type' => $planData['mlm_genealogy_type'],
            ]);

            foreach ($planData['labels'] as $label) {
                MlmPlanLabel::create([
                    'plan_code' => $label['plan_code'],
                    'plan_name' => $label['plan_name'],
                    'mlm_plan_id' => $plan->mlm_plan_id,
                ]);
            }
        }

        // Insert global labels (not tied to any specific plan)
        $globalLabels = [
            [
                'plan_code' => 'PERSONAL_STAIRSTEP_PV_LABEL',
                'plan_name' => 'Personal Stair Step PV',
                'mlm_plan_id' => null,
            ],
            [
                'plan_code' => 'GROUP_STAIRSTEP_PV_LABEL',
                'plan_name' => 'Group Stair Step PV',
                'mlm_plan_id' => null,
            ],
            [
                'plan_code' => 'STAIRSTEP_EARNING_POINTS_LABEL',
                'plan_name' => 'Stair Step Earning Points',
                'mlm_plan_id' => null,
            ],

            //Binary
            [
                'plan_code' => 'BINARY_POINTS_LEFT',
                'plan_name' => 'BINARY POINTS LEFT',
                'mlm_plan_id' => null,
            ],
            [
                'plan_code' => 'BINARY_POINTS_RIGHT',
                'plan_name' => 'BINARY POINTS RIGHT',
                'mlm_plan_id' => null,
            ],
        ];

        foreach ($globalLabels as $label) {
            MlmPlanLabel::create($label);
        }
    }
}
