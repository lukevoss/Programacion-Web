<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //added
    public function image(){
        return $this->hasOne(Picture::class);
    }
    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }
}
