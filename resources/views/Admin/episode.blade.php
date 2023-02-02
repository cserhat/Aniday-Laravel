<style>
  @import url('https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&family=Poppins:wght@600&display=swap');

* {
    box-sizing: border-box
}

body {
    background-color: #d9ecf2;
    font-family: 'Poppins', sans-serif;
    color: #666
}

.h2 {
    color: #444;
    font-family: 'PT Sans', sans-serif
}

thead {
    font-family: 'Poppins', sans-serif;
    font-weight: bolder;
    font-size: 20px;
    color: #666
}

img {
    width: 40px;
    height: 40px
}

.name {
    display: inline-block
}

.bg-blue {
    background-color: #EBF5FB;
    border-radius: 8px
}

.fa-check,
.fa-minus {
    color: blue
}

.bg-blue:hover {
    background-color: #3e64ff;
    color: #eee;
    cursor: pointer
}

.bg-blue:hover .fa-check,
.bg-blue:hover .fa-minus {
    background-color: #3e64ff;
    color: #eee
}

.table thead th,
.table td {
    border: none
}

.table tbody td:first-child {
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px
}

.table tbody td:last-child {
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px
}

#spacing-row {
    height: 10px
}
.hidden 
{
  display:none;
}
@media(max-width:575px) {
    .container {
        width: 125%;
        padding: 20px 10px
    }
}
</style>
@extends('layouts.admin-header')
@section('content')
<div class="container rounded mt-5 bg-white p-md-5">
    <div class="h2 font-weight-bold">Episode: <a href="/admin/episode-add"><button type="submit" class="btn btn-success">New</button></a></div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Anime:</th>
                    <th scope="col">Episode:</th>
                    <th scope="col">Anime Id:</th>
                </tr>
            </thead>
            <tbody>
            @foreach($episodes as $episode)
                <tr class="bg-blue">
                    <td class="pt-3"> <img src="../{{ $episode->anime_image }}" class="rounded-circle" alt="">
                        <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $episode->anime_title }}</div>
                    </td>
                    
                    <td class="pt-3" >{{ $episode->episode_title }}</td>

                    <td class="pt-3">{{ $episode->anime_id }}</td>

                    <td class="pt-3"><a href="{{ url('/admin/anime/edit/'.$episode->episode_id.'') }}"><button type="button" class="btn btn-info">Edit</button></a></td>
                    
                    <td class="pt-3">
                    <form method="post" action="{{ url('/admin/episode' .'/' .$episode->episode_id ) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Delete</button> 
                    </form>
                  </td>

                </tr>
                <tr id="spacing-row">
                    <td></td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
        <center class="mt-5">
       {{ $episodes->appends(Request::all())->links()}}
       </center>

    </div>
</div>
@endsection