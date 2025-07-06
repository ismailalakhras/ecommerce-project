<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $coupons = [
            [
                'code' => 'WELCOME10',
                'type' => 'percentage',
                'value' => 10.00,
                'minimum_amount' => 50.00,
                'usage_limit' => 100,
                'used_count' => 0,
                'is_active' => true,
                'starts_at' => Carbon::now()->subDays(1),
                'expires_at' => Carbon::now()->addMonths(1),
            ],
            [
                'code' => 'FLAT5',
                'type' => 'fixed',
                'value' => 5.00,
                'minimum_amount' => null,
                'usage_limit' => null,
                'used_count' => 0,
                'is_active' => true,
                'starts_at' => null,
                'expires_at' => null,
            ],
            [
                'code' => 'SUMMER20',
                'type' => 'percentage',
                'value' => 20.00,
                'minimum_amount' => 100.00,
                'usage_limit' => 50,
                'used_count' => 0,
                'is_active' => false,
                'starts_at' => Carbon::now()->subMonths(2),
                'expires_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
