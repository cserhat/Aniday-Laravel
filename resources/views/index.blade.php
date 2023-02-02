
@extends('layouts.app')
@section('content')

@foreach($animes as $anime)

<div class="card">  
            <div class="type"><span>{{ $anime->anime_type }}</span></div>
            <div class="titre"><span>{{ $anime->anime_title }}</span></div>
            <div class="banner"><img src="{{ $anime->anime_image }}" alt=""></div> 
            <div class="btn">
            @if (session('logged_in'))
            @if($watched == null)
               <button class="watched-button" onclick="Watched({{$anime->anime_id}}, {{auth()->user()->id}})" data-anime-id="{{$anime->anime_id}}">
                  <img src="storage/images/plus.png" alt=""></i></i>
               </button>
            @endif
      
            @if($watched->contains('anime_id', $anime->anime_id))
               <button class="watched-button" onclick="RemoveWatch({{$anime->anime_id}}, {{auth()->user()->id}})" data-anime-id="{{$anime->anime_id}}">
                  <img src="storage/images/ok.png" alt=""></i></i>
               </button>
              @else
              <button class="watched-button" onclick="Watched({{$anime->anime_id}}, {{auth()->user()->id}})" data-anime-id="{{$anime->anime_id}}">
                  <img src="storage/images/plus.png" alt=""></i></i>
               </button>

               @endif
         
      
            @else
               <button><img onclick="changeImageNotLogin(event)" src="storage/images/plus.png" alt=""></i></i></button>
            @endif

            </div>
            <div class="btn" >
            <a href="/anime/{{$anime->anime_slug}}"> <button id="gauche"><i class='bx bx-play' style='color:#ffffff' ></i></i></i></button></a>
            </div>
</div>

@endforeach
<div class="center">
<div class="pagination">
{{ $animes->appends(Request::all())->links()}}
</div>
</div>
@endsection