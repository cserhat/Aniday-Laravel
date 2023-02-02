
@extends('layouts.app')
@section('content')
<div class="profile">
               <div class="profile-header">
                  <!-- BEGIN profile-header-cover -->
                  <div class="profile-header-cover">
                    
                  </div>
                  <!-- END profile-header-cover -->
                  <!-- BEGIN profile-header-content -->
                  <div class="profile-header-content">
                     <!-- BEGIN profile-header-img -->
                     <div class="profile-header-img">
                        <img src="https://www.feedingmatters.org/wp-content/uploads/2020/02/placeholder-user-400x400-1.png" alt="">
                     </div>
                     <!-- END profile-header-img -->
                     <!-- BEGIN profile-header-info -->
                     <div class="profile-header-info">
                        <h4 class="m-t-10 m-b-5">{{ Auth::user()->name }}</h4>
                        <p class="m-b-10">{{ Auth::user()->user_role }}</p>
                        <p class="m-b-10">{{ Auth::user()->email }}</p>
                        <a href="#" class="btn btn-sm btn-info mb-2">Edit Profile</a>
                     </div>
                     <!-- END profile-header-info -->
                  </div>
                </div>
<div class="position-relative">
<div class="text-center">
  <h4>MY LIST</h4>
</div>
@foreach($watched as $watch)

<figure class="snip1578" data-anime-id="{{$watch->anime_id}}"><img src="{{$watch->anime_image}}" alt=""/>
  <figcaption>
    <h3>{{$watch->anime_title}}</h3>
    <div class="icons">
    <a href="/anime/{{$watch->anime_slug}}"><button class="btn btn-success" type="submit">See More</button>  </a>
    <button class="btn btn-danger" onclick="RemoveWatchFromDashboard({{$watch->anime_id}}, {{auth()->user()->id}})">Remove</button>
       
    </div>
  </figcaption>
</figure>

@endforeach
</div>
</div>
<div class="center">
<div class="pagination">
{{ $watched->appends(Request::all())->links()}}
</div>
</div>
</div>
@endsection