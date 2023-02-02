
@extends('layouts.app')
@section('content')
@foreach( $episodes as  $episode)

    <div class="card">  
            <div class="type"><span>{{ $episode->anime_type }}</span></div>
            <div class="titre"><span> {{ $episode->episode_title }}</span></div>
            <div class="banner"><img src="{{ $episode->anime_image }}" alt=""></div> 
            <div class="btn">
          
            </div>
            <div class="btn" >
            <a href="/watch/{{$episode->episode_slug}}/{{$episode->anime_id}}"> <button id="gauche"><i class='bx bx-play' style='color:#ffffff' ></i></i></i></button></a>
            </div>
    </div>

@endforeach
<div class="center">
<div class="pagination">
{{ $episodes->appends(Request::all())->links()}}
</div>
</div>
@endsection

</script>