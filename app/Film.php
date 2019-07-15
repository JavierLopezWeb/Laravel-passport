<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Film extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'detail','video','vote_count','popularity','poster_path','original_language',
        'original_title','genre_ids','backdrop_path','overview','release_date','modified'
    ];
}
