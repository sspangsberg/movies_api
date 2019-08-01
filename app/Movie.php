<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['user_id', 'title', 'genre','description', 'imdb_rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
