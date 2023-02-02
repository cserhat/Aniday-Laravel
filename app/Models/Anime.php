<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Anime extends Model
{
    use HasFactory;
    protected $table = 'anime'; 
    protected $primaryKey = 'anime_id';
    protected $cascadeDeletes = ['watched'];
    protected $fillable = [
         'anime_title','anime_image', 'anime_description', 'anime_type'
        ,'anime_genres','anime_duration','anime_aired','anime_score','anime_episode'
    ];

}
