<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watched extends Model
{
    use HasFactory;
    protected $table = 'watched'; 
    protected $primaryKey = 'watched_id';
    protected $cascadeDeletes = ['watched_ibfk_1'];
    protected $fillable = ['watched_slug', 'anime_id', 'user_id', 'is_watched'];
}
