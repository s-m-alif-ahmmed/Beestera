<?php

namespace App\Models;

use Laravelcm\Subscriptions\Models\Plan as BasePlan;

class Plan extends BasePlan
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'product_id',
        'name',
        'description',
        'price',
        'signup_fee',
        'invoice_period',
        'invoice_interval',
        'trial_period',
        'trial_interval',
        'sort_order',
        'currency',
    ];

    /**
     * Find a plan by its RevenueCat product ID.
     *
     * @param string $productId
     * @return static|null
     */
    public static function findByProductId(string $productId)
    {
        return static::where('product_id', $productId)->first();
    }

    /**
     * Create or update a plan from RevenueCat data.
     *
     * @param array $data
     * @return static
     */
    public static function createFromRevenueCat(array $data)
    {
        return static::updateOrCreate(
            ['product_id' => $data['product_id']],
            [
                'name' => $data['name'] ?? $data['product_id'],
                'description' => $data['description'] ?? '',
                'price' => $data['price'] ?? 0,
                'signup_fee' => $data['signup_fee'] ?? 0,
                'invoice_period' => $data['invoice_period'] ?? 1,
                'invoice_interval' => $data['invoice_interval'] ?? 'month',
                'trial_period' => $data['trial_period'] ?? 0,
                'trial_interval' => $data['trial_interval'] ?? null,
                'sort_order' => $data['sort_order'] ?? 0,
                'currency' => $data['currency'] ?? 'USD',
            ]
        );
    }
} 