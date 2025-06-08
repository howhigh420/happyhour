<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'balance', 'portfolio_value', 'active_positions', 'return_rate'];

    // Example accessor for balance_change
    public function getBalanceChangeAttribute()
    {
        // Replace with real logic
        return '+12.5% from last month';
    }

    public function getPortfolioChangeAttribute()
    {
        return '+8.3% today';
    }

    public function getPositionChangeAttribute()
    {
        return '+3 new positions';
    }

    public function getReturnChangeAttribute()
    {
        return '+2.1% from last period';
    }
}