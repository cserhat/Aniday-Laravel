<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $table = 'episode'; 
    protected $primaryKey = 'episode_id';

    protected $fillable = ['episode_title', 'episode_slug', 'anime_id'];
}
