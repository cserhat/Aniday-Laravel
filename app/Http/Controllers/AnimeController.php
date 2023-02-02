<?php

namespace App\Http\Controllers;
use App\Models\Genres;
use App\Models\Watched;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Anime;// Ajoute Anime Mode - Le data va venir dans notre  model
class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animes = Anime::latest('anime_id')->paginate(12);
        if (Auth::check()){
            $watched = Watched::where('user_id', Auth::user()->id)->get();
        }
        else
        {
            $watched = watched::all();
        }
        return view ('index', compact('animes', 'watched'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animes = Genres::all();
        return view('admin.anime.anime-add' ,compact('animes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Je fait une request all pour recupere tous les données  */
        $data = $request->all();
        $anime = new Anime;
        /* Je recupere le fichier qui a une name anime_image je le sauvegarde dans public/image */
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
        $anime->anime_trailer = $data['anime_trailer'];
        $anime->anime_studios = $data['anime_studios'];
        $anime->anime_producers = $data['anime_producers'];
        $anime->anime_genres = $data['anime_genres'];
        $anime->anime_duration = $data['anime_duration'];
        $anime->anime_aired = $data['anime_aired'];
        $anime->anime_score = $data['anime_score'];
        $anime->anime_episode = $data['anime_episode'];
        $anime->save();

        return redirect('/admin/anime')->with('success', 'Anime created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $animes = Anime::where('anime_slug', $slug)
        ->leftJoin('episode', 'anime.anime_id', '=', 'episode.anime_id' )
        ->leftJoin('genres', 'anime.anime_genres', '=', 'genres.genres_id')
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToWatched(Request $request)
    {
        // je recupere anime_id
        $anime_id = $request->anime_id;
        // je recupere user_id
        $user_id = $request->user_id;
        //mon watched slug est egale a anime_id et user_id
        $watched_slug = $request->anime_id.$request->user_id;
        // je crée nouveau watched
        Watched::create([
            // j'ajoute watched_slug dans column watched_slug
            'watched_slug' => $watched_slug,
            // j'ajoute anime_id dans column anime_id
            'anime_id' => $anime_id,
            // j'ajoute user_id dans column user_id
            'user_id' => $user_id,
            // je rêgle is_watched a 1
            'is_watched' => '1'
        ]);
        return response()->json(['message' => 'Anime added to watched']);
    }
    public function deletewatch($anime_id)
    {
        // Effacer anime dans watched quand user_id est mêmê que user connectée 
        Watched::where('anime_id', $anime_id)->where('user_id', Auth::user()->id)->delete();

        // Return sucess reponse a console
        return response()->json(['success' => true]);
    }
}
