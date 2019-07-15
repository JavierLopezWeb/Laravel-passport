<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class filmLists extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','film_list', 'user_id'
    ];
}
