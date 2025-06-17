<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmiRule extends Model
{
    protected $fillable = [
        'min_amount',
        'max_amount',
        'tenure_id',
        'interest_rate',
    ];

    public function tenure()
    {
        return $this->belongsTo(Tenure::class);
    }
}
