<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'phone', 'country', 'is_admin', 'balance', 'portfolio_value', 'active_positions', 'return_rate'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];
    
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