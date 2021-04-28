<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecipeRelation extends Model
{
    protected $fillable = [
        'cooked', 'user_id', 'fav', 'shopping', 'rating'
    ];

    use HasFactory;

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
