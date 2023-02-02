
@extends('layouts.app')
@section('content')
@foreach($animes as $anime)

<div class="info-box">
  <div class="info-cover"></div>
  <div class="info-box__item">
    <div class="info-box__img">

      <img src="../{{$anime->anime_image}}" alt="anime">
    </div>
    <div class="info-box__content">

      <h2 class="title-description">{{$anime->anime_title}}</h2>
      <div class="alias">ひとつなぎの大秘宝</div>
      <div class="synom">Synopsis:</div>
      <p class="shorting">
        {{$anime->anime_description}}
      </p>
      <div class="meta">
        <div class="col1">
          <div id="typ">{{ $anime->anime_type }}</div>
          <div id="stu">{{ $anime->anime_studios }}</div>
          <div id="prod">{{ $anime->anime_producers }}</div>
          <div id="stat">{{ $anime->anime_status }}</div>
          <div id="epino">{{ $anime->anime_episode }}</div>
        </div>
        <div class="col2">
          <div id="gener">{{ $anime->genres_type }}</div>
          <div id="scr">{{ $anime->anime_score }}</div>
          <div id="dur">{{$anime->anime_duration}}</div>
          <div id="date">{{ date("d F Y",strtotime($anime->anime_aired)) }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="trailer">
    <div class="episode">
    @foreach($animes as $episode)
@if(isset($episode->episode_title))
  <li><a href="/watch/{{ $episode->episode_slug }}/{{ $episode->anime_id }}">{{ $episode->episode_title }}</a></li>
@endif
@endforeach
    </div>
    <iframe width="560" height="315" src="{{ $anime->anime_trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
</div>
@break
@endforeach


@endsection

