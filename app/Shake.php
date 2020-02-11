<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShakeIngredient;

class Shake extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    public function ingredients()
    {
        return $this->hasMany(ShakeIngredient::class);
    }

}
