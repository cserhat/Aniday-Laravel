@extends('layouts.admin-header')
@section('content')
<style>
  .badge
  {
    background:red;
  }
</style>
<h4>Jikan Api<span class="badge badge-danger">New</span></h4>
<h5 class="color-danger">How it works:</h5>
<span>
<h4>
  This an Jikan api and don't work correctly everytime.
  If you can add anime just add manualy i will update.
  </h4>
</span>
<p>
  <h4>You need id from myanimelist. https://myanimelist.net/anime/21/One_Piece
    id is 21.
  </h4>
</p>
<form action="{{route('api-search')}}" method="post">
  @csrf
  <label for="anime_id" class="form-label">Anime ID:</label>
  <input class="form-control" type="text" name="anime_id">
  <br>
  <input class="btn btn-success w-100" type="submit" value="Submit">
</form>
@endsection