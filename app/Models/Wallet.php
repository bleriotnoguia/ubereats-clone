<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /**
     * Retrieve all transactions
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    /**
     * Retrieve owner
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
