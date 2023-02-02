<?php

namespace App\Http\Controllers;
use App\Models\Genres;
use App\Models\Episode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Anime;// Ajoute Anime Mode - Le data va venir dans notre  model
use App\Models\Watched;
class AdminAnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animes = Anime::latest()->paginate(5);
        return view ('admin/anime')->with('animes', $animes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $animes = Anime::where('anime_slug', $slug)
        ->leftJoin('episode', 'anime.anime_id', '=', 'episode.anime_id' )
        ->get();
        return view('animes.anime' ,compact('animes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animes = Anime::where('anime_id',$id)->first();
        $genres = Genres::all();
        return view('admin/anime/edit')->with('animes', $animes)->with('genres', $genres);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $anime_id)
    {
        /* Je recupere tout les requette de formulaire */
        $data = $request->all();
        $anime = Anime::find($anime_id);
        /* Je recupere le requette fichier de la formulaire qui a une name=anime_image et je le sauvegarde dans public/image */
        $imagePath = $request->file('anime_image')->store('public/images/');
        /* Je utilise str_replace pour enleve le public dans imagepath */
        $url = str_replace('public' , '', $imagePath);
        /* Dans le column anime image j'envoi le url de l'image */
        $anime->anime_image = 'storage/'.$url;
        /* Dans le column anime_title j'envoi donne que je recupere dans anime_title*/
        $anime->anime_title = $data['anime_title'];
        $anime->anime_genres = $data['anime_genres'];
        $anime->anime_slug = Str::slug($data['anime_title']);
        $anime->anime_description = $data['anime_description'];
        $anime->anime_type = $data['anime_type'];
        $anime->anime_genres = $data['anime_genres'];
        $anime->anime_duration = $data['anime_duration'];
        $anime->anime_aired = $data['anime_aired'];
        $anime->anime_score = $data['anime_score'];
        $anime->anime_episode = $data['anime_episode'];
        $anime->save();
        return redirect('admin/anime');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($anime_id)
    {
        // Supprimer les épisodes associés à l'anime avec l'ID donné
        Episode::whereIn('anime_id', [$anime_id])->delete();
        // Supprimer les informations de visionnage associées à l'anime avec l'ID donné
        Watched::where('anime_id', $anime_id)->delete();
        // Récupérer l'enregistrement de l'anime avec l'ID donné
        $anime = Anime::where('anime_id', $anime_id);
        // Supprimer l'enregistrement de l'anime
        $anime->delete();
        // Rediriger vers la page d'administration des animes
        return redirect('admin/anime');
    }
    
}
