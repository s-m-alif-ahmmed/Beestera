<?php

namespace Database\Seeders;

use App\Enums\SubscriptionPlanEnum;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Laravelcm\Subscriptions\Interval;
use Laravelcm\Subscriptions\Models\Feature;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the plans configuration
        $plans = [
            // Monthly Plans
            [
                'product_id' => SubscriptionPlanEnum::basicMonthly,
                'name' => 'Basic Monthly',
                'slug' => 'basic-monthly',
                'description' => 'Basic monthly subscription plan',
                'price' => 9.99,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::MONTH->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 1,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::proMonthly,
                'name' => 'Pro Monthly',
                'slug' => 'pro-monthly',
                'description' => 'Pro monthly subscription plan',
                'price' => 19.99,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::MONTH->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 2,
                'currency' => 'USD',
            ],

            // Yearly Plans (with discount)
            [
                'product_id' => SubscriptionPlanEnum::basicYearly,
                'name' => 'Basic Yearly',
                'slug' => 'basic-yearly',
                'description' => 'Basic yearly subscription plan (Save 20%)',
                'price' => 95.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 3,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::proYearly,
                'name' => 'Pro Yearly',
                'slug' => 'pro-yearly',
                'description' => 'Pro yearly subscription plan (Save 20%)',
                'price' => 191.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 4,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::trainingYearly,
                'name' => 'Training Annual',
                'slug' => 'training-yearly',
                'description' => 'Training annual subscription plan (Save 20%)',
                'price' => 200.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 5,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::trainingByYearly,
                'name' => 'Training Bi-Annual',
                'slug' => 'training-by-yearly',
                'description' => 'Training bi-annual subscription plan (Save 20%)',
                'price' => 250.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 6,
                'currency' => 'USD',
            ],

            // Android
            // Monthly Plans
            [
                'product_id' => SubscriptionPlanEnum::basicMonthlyAndroid,
                'name' => 'Basic Monthly',
                'description' => 'Basic monthly subscription plan',
                'slug' => 'basic-monthly-android',
                'price' => 9.99,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::MONTH->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 1,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::proMonthlyAndroid,
                'name' => 'Pro Monthly',
                'slug' => 'pro-monthly-android',
                'description' => 'Pro monthly subscription plan',
                'price' => 19.99,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::MONTH->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 2,
                'currency' => 'USD',
            ],

            // Yearly Plans (with discount)
            [
                'product_id' => SubscriptionPlanEnum::basicYearlyAndroid,
                'name' => 'Basic Yearly',
                'slug' => 'basic-yearly-android',
                'description' => 'Basic yearly subscription plan (Save 20%)',
                'price' => 95.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 3,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::proYearlyAndroid,
                'name' => 'Pro Yearly',
                'slug' => 'pro-yearly-android',
                'description' => 'Pro yearly subscription plan (Save 20%)',
                'price' => 191.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 4,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::trainingYearlyAndroid,
                'name' => 'Training Annual',
                'slug' => 'training-yearly-android',
                'description' => 'Training annual subscription plan (Save 20%)',
                'price' => 200.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 5,
                'currency' => 'USD',
            ],
            [
                'product_id' => SubscriptionPlanEnum::trainingByYearlyAndroid,
                'name' => 'Training Bi-Annual ',
                'slug' => 'training-by-yearly-android',
                'description' => 'Training bi-annual subscription plan (Save 20%)',
                'price' => 250.88,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => Interval::YEAR->value,
                'trial_period' => 0,
                'trial_interval' => Interval::DAY->value,
                'sort_order' => 6,
                'currency' => 'USD',
            ],
        ];

        // Create or update plans and their features
        foreach ($plans as $planData) {
            $plan = Plan::updateOrCreate(
                ['product_id' => $planData['product_id']],
                $planData
            );

            // Define features based on plan type
            $features = [];

            if (str_contains($planData['name'], 'Basic')) {
                $features = [
                    ['name' => 'listings', 'value' => 50, 'sort_order' => 1],
                    ['name' => 'pictures_per_listing', 'value' => 10, 'sort_order' => 5],
                    ['name' => 'listing_duration_days', 'value' => 30, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'month'],
                    ['name' => 'listing_title_bold', 'value' => 'N', 'sort_order' => 15]
                ];
            } elseif (str_contains($planData['name'], 'Pro')) {
                $features = [
                    ['name' => 'listings', 'value' => 100, 'sort_order' => 1],
                    ['name' => 'pictures_per_listing', 'value' => 20, 'sort_order' => 5],
                    ['name' => 'listing_duration_days', 'value' => 60, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'month'],
                    ['name' => 'listing_title_bold', 'value' => 'Y', 'sort_order' => 15]
                ];
            } elseif (str_contains($planData['name'], 'Training')) {
                $features = [
                    ['name' => 'listings', 'value' => 200, 'sort_order' => 1],
                    ['name' => 'pictures_per_listing', 'value' => 30, 'sort_order' => 5],
                    ['name' => 'listing_duration_days', 'value' => 90, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'month'],
                    ['name' => 'listing_title_bold', 'value' => 'Y', 'sort_order' => 15]
                ];
            }

            // Create features for the plan
            foreach ($features as $featureData) {
                $plan->features()->updateOrCreate(
                    ['name' => $featureData['name']],
                    $featureData
                );
            }
        }
    }
}
