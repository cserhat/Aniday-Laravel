<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Episode;
use App\Models\Anime;
class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::
        Join('anime', 'episode.anime_id', '=', 'anime.anime_id' )
        ->orderBy('episode_id', 'DESC')->paginate(12);
        return view('episodes' ,compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $episodes = Anime::all();
        return view('admin.episode.episode-add' ,compact('episodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $episode = new Episode;

        $episode->episode_title = $data['episode_title'];
        $title = $data['anime_title'].' '.$data['episode_title'];
        $episode->episode_slug = Str::slug($title);
        $episode->anime_id = $data['anime_id'];
        $episode->save();
        return redirect('admin/episode')->with('success', 'Episode created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $anime_id)
    {
        $episode = Episode::where('episode_slug', $slug)->
        Join('anime', 'episode.anime_id', '=', 'anime.anime_id' )->
        Join('iframe', 'episode.episode_id', '=' , 'iframe.episode_id')
        ->get();
        
        $list = Episode::where('episode.anime_id', $anime_id)
        ->leftJoin('anime', 'anime.anime_id', '=', 'episode.anime_id' )
        ->get();
        return view('watch.episode' ,compact('episode','list'));
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
}
