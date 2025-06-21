<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenure extends Model
{
    protected $fillable = [
        'months',
    ];

    public function emiRules()
    {
        return $this->hasMany(EmiRule::class);
    }
}
