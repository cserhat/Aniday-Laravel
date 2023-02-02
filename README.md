# Laravel for beginner : 

## Create a laravel project : 
    1. composer global require laravel/installer
    2. laravel new example-app
## Start server :
    php artisan serve
    go on http://127.0.0.1:8000
## Change Database information in .env file
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ecomerce
    DB_USERNAME=root
    DB_PASSWORD=123456798
## Create Table
    php artisan make:migration create_anime_table
    Check database/migration file and add your need on table like this $table->string("title");
    Migrate to your database "php artisan migrate"
## Create Controller 
    php artisan make:controller AnimeController --resource
    $animes = Anime::all(); /fetching all data
    return view ('animes.index')->with('animes', $animes); //return fetch as to view
## Create Model 
    php artisan make:model Anime
    protected $table = 'anime'; // Table name
    protected $primaKey = 'id'; // Table primary key
    protected $filliable = ['title','title_jap','type','status','duration','date','rating','agerating','synopsy']; // Table other info
## Route
    In Routes/web.php add your route Route::resource('/anime', AnimeController::class );
    After create a file in resources/views create a an animes/index.blade.php for render
## Fetch Data
    @foreach($animes as $anime)
    <h1>{{ $anime->title }}</h1>
    @endforeach

Made by Guts