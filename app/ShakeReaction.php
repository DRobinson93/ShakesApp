<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShakeReaction extends Model
{
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
