<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Shake
 * @package App
 * @property integer user_id
 * @property User user
 */
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
        return $this->hasMany(ShakeReaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
