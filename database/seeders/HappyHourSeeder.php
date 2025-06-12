<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Asset;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class HappyHourSeeder extends Seeder
{
    public function run()
    {
        // Create test user
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@happyhour.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@happyhour.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        // Create assets
        $usd = Asset::create(['name' => 'US Dollar', 'symbol' => 'USD']);
        $btc = Asset::create(['name' => 'Bitcoin', 'symbol' => 'BTC']);
        $eth = Asset::create(['name' => 'Ethereum', 'symbol' => 'ETH']);

        // Create balances for test user
        Balance::create([
            'user_id' => $testUser->id,
            'asset_id' => $usd->id,
            'amount' => 1000.00,
        ]);
        Balance::create([
            'user_id' => $testUser->id,
            'asset_id' => $btc->id,
            'amount' => 0.05,
        ]);
        Balance::create([
            'user_id' => $testUser->id,
            'asset_id' => $eth->id,
            'amount' => 1.00,
        ]);

        // Create balances for admin user
        Balance::create([
            'user_id' => $adminUser->id,
            'asset_id' => $usd->id,
            'amount' => 5000.00,
        ]);
        Balance::create([
            'user_id' => $adminUser->id,
            'asset_id' => $btc->id,
            'amount' => 0.10,
        ]);
        Balance::create([
            'user_id' => $adminUser->id,
            'asset_id' => $eth->id,
            'amount' => 2.00,
        ]);

        // Create transactions for test user
        Transaction::create([
            'user_id' => $testUser->id,
            'type' => 'deposit',
            'asset_id' => $usd->id,
            'amount' => 1000.00,
            'status' => 'completed',
            'address' => null,
        ]);
        Transaction::create([
            'user_id' => $testUser->id,
            'type' => 'deposit',
            'asset_id' => $btc->id,
            'amount' => 0.05,
            'status' => 'completed',
            'address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
        ]);

        // Create transactions for admin user
        Transaction::create([
            'user_id' => $adminUser->id,
            'type' => 'deposit',
            'asset_id' => $usd->id,
            'amount' => 5000.00,
            'status' => 'completed',
            'address' => null,
        ]);
        Transaction::create([
            'user_id' => $adminUser->id,
            'type' => 'deposit',
            'asset_id' => $btc->id,
            'amount' => 0.10,
            'status' => 'completed',
            'address' => '3J98t1WpEZ73CNmQviecrnyiWrnqRhWNLy',
        ]);

        // Create sample orders
        Order::create([
            'user_id' => $adminUser->id,
            'asset_id' => $usd->id,
            'type' => 'buy',
            'amount' => 100.00,
            'price' => 1.00,
            'status' => 'pending',
        ]);
        Order::create([
            'user_id' => $adminUser->id,
            'asset_id' => $btc->id,
            'type' => 'sell',
            'amount' => 0.01,
            'price' => 60000.00,
            'status' => 'completed',
        ]);
    }
}