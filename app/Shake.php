<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shake extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id'
    ];

    public function ingredients()
    {
        return $this->hasMany(ShakeIngredient::class);
    }

    public function reactions()
    {
        return $this->hasMany(ShakeIngredient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
