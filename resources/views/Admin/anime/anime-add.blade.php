@extends('layouts.admin-header')
@section('content')
<div class="card">
   <div class="card-header">Add New Anime</div>
   <div class="card-body">
<form method="POST" action="{{ url('anime') }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
      <label for="anime_title" class="form-label">Anime Title:</label>
      <input type="text" name="anime_title" required  class="form-control" id="anime_title" placeholder="Exemple: One Piece">
      
      <label for="anime_genres" class="form-label">Anime Genres:</label>

      <select required class="form-select" aria-label="Default select example" name="anime_genres" id="anime_genres">
         @foreach($animes as $genre)
         <option value="{{ $genre->genres_id }}">{{ $genre->genres_type }}</option>
          @endforeach
      </select>

      <label for="anime_image" class="form-label">Upload Image:</label>
      <input  required type="file" class="form-control" name="anime_image">

      <label for="anime_description" class="form-label">Anime Description:</label>
      <textarea required name="anime_description" class="form-control" id="" cols="30" rows="10"></textarea>
   
      <label for="anime_studios" class="form-label">Anime Studios:</label>
      <input type="text" required name="anime_studios" class="form-control">

      <label for="anime_producers" class="form-label">Anime Producers:</label>
      <input type="text" required name="anime_producers" class="form-control">

   <label for="anime_type" class="form-label">Anime Type:</label>
   <select required  class="form-select" name="anime_type" id="">
      <option value="TV">Tv</option>
      <option value="Ova">Ova</option>
      <option value="Movie">Movie</option>
   </select>

   <label for="anime_status" class="form-label">Anime Status:</label>
   <select required class="form-select" name="anime_status" id="">
      <option value="Currently Airing">Currently Airing</option>
      <option value="Finished Airing">Finished Airing</option>
   </select>

   <label for="anime_trailer" class="form-label">Anime Trailer:</label>
   <input type="text" class="form-control" required name="anime_trailer" placeholder="Add Embed Form"id="">

   <label for="anime_duration" class="form-label">Anime Duration:</label>
   <input type="text" class="form-control" required  name="anime_duration" placeholder="Duration">

   <label for="anime_aired">Anime Aired:</label>
   <input type="date" class="form-control date" required name="anime_aired" id="" placeholder="Anime Duration">

   <label for="anime_score" class="form-label">Anime Score:</label>
   <input type="text" class="form-control" required name="anime_score" placeholder="Anime Score">

   <label for="anime_episode">Anime Episode:</label>
   <input type="text" class="form-control" required name="anime_episode" placeholder="Total Episode">
<br>
   <button class="btn btn-success" type="submit">Add Anime</button>
   </div>
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@endsection