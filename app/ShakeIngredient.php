<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shake;

class ShakeIngredient extends Model
{
    public function shake()
    {
        return $this->belongsTo(Shake::class);
    }
}
