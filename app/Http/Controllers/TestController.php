<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Str;
use DateTime;
class TestController extends Controller
{
    public function show()
    {
        return view('api');
    }
    
    public function store(Request $request)
    {
    $id = $request->input('anime_id');
    $response = Http::get("https://api.jikan.moe/v4/anime/{$id}");
    $animeData = $response->json();
    $anime = new Anime;
    $anime->anime_title = $animeData['data']['title'];
    if (is_null($animeData['data']['episodes'])) {
        $anime->anime_episode = 'Unknow';
    }
    else
    {
         $anime->anime_episode = $animeData['data']['episodes'];
    }
    $anime->anime_slug = Str::slug($animeData['data']['title']);
    $anime->anime_description = $animeData['data']['synopsis'];
    $anime->anime_duration = $animeData['data']['duration'];
    $anime->anime_score = $animeData['data']['score'];
    if (is_null($animeData['data']['trailer']['embed_url'])) {
        $anime->anime_trailer = 'https://www.youtube.com/embed';
    }
    else
    {
        $anime->anime_trailer = $animeData['data']['trailer']['embed_url'];
    }
    $anime->anime_type = $animeData['data']['type'];
    $anime->anime_status = $animeData['data']['status'];
    $mal_ids = array_column($animeData['data']['genres'], 'mal_id');
    foreach ($animeData['data']['genres'] as $genre) {
        $mal_id = $genre['mal_id'];
        $anime->anime_genres = $mal_id;
        break;
    }
    $studios = array_column($animeData['data']['studios'], 'name');
    foreach ($animeData['data']['studios'] as $studios) {
        $anime_studios = $studios['name'];
        $anime->anime_studios = $anime_studios;
    }
    
    $studios = array_column($animeData['data']['producers'], 'name');
    foreach ($animeData['data']['producers'] as $producers) {
        if(is_null($producers['name']))
        {
            $anime->anime_producers = 'Unknow Producers';
        }
        else
        {
        $anime_producers = $producers['name'];
        $anime->anime_producers = $anime_producers;
        }
    }
    $dateTimeString = $animeData['data']['aired']['from'];
    $dateTime = new DateTime($dateTimeString);
    $date = $dateTime->format('Y-m-d');
    $anime->anime_aired = $date;
    $imageUrl = $animeData['data']['images']['jpg']['image_url'];
    $imageData = file_get_contents($imageUrl);
    $imageName = uniqid().'.jpg';
    $imagePath = public_path("storage/".$imageName);
    file_put_contents($imagePath, $imageData);
    $anime->anime_image = '/storage/'.$imageName;
    $anime->save();

    return redirect('admin/anime');
   
    }

}