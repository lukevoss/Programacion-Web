<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'instructions', 'minutes', 'user_id'
    ];

    public function image(){
        return $this->hasOne(Picture::class);
    }
    public function ingredient(){
        return $this->hasMany(Ingredient::class);
    }
}
