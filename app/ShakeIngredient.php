<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shake;

class ShakeIngredient extends Model
{
    protected $fillable = [
        'shake_id', 'val'
    ];

    public function shake()
    {
        return $this->belongsTo(Shake::class);
    }
}
