<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\User;
    use App\Models\Asset;
    use App\Models\Balance;
    use App\Models\Transaction;
    use Illuminate\Support\Facades\Hash;

    class HappyHourSeeder extends Seeder
    {
        public function run()
        {
            // Create a test user with verified email
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@happyhour.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(), // Mark email as verified
            ]);

            // Create assets (USD, BTC, ETH)
            $usd = Asset::create(['name' => 'US Dollar', 'symbol' => 'USD']);
            $btc = Asset::create(['name' => 'Bitcoin', 'symbol' => 'BTC']);
            $eth = Asset::create(['name' => 'Ethereum', 'symbol' => 'ETH']);

            // Create balances for the test user
            Balance::create([
                'user_id' => $user->id,
                'asset_id' => $usd->id,
                'amount' => 1000.00,
            ]);
            Balance::create([
                'user_id' => $user->id,
                'asset_id' => $btc->id,
                'amount' => 0.05,
            ]);
            Balance::create([
                'user_id' => $user->id,
                'asset_id' => $eth->id,
                'amount' => 1.00,
            ]);

            // Create sample transactions
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'deposit',
                'asset_id' => $usd->id,
                'amount' => 1000.00,
                'status' => 'completed',
                'address' => null,
            ]);
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'deposit',
                'asset_id' => $btc->id,
                'amount' => 0.05,
                'status' => 'completed',
                'address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            ]);
        }
    }