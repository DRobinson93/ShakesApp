<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShakeReaction extends Model
{
    const DEFAULT_VAL=0;
    protected $fillable = [
        'user_id', 'val', 'shake_id'
    ];

    public function shake()
    {
        return $this->belongsTo(Shake::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
