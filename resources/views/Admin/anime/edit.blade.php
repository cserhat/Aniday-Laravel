@extends('layouts.admin-header')
@section('content')
<div class="card">
   <div class="card-header">Update Anime</div>
   <div class="card-body">
   <form method="POST" action="{{ route('admin.update-anime',['anime_id' => $animes->anime_id]) }}" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="mb-3">

      <label for="anime_title" class="form-label">Anime Title:</label>
      <input type="text" name="anime_title"  class="form-control" id="anime_title" value="{{ $animes->anime_title }}">
      
      <label for="anime_genres" class="form-label">Anime Genres:</label>

      <select class="form-select" aria-label="Default select example" name="anime_genres" id="anime_genres">

      @foreach($genres as $genre)
         <option required value="{{ $genre->genres_id }}">{{ $genre->genres_type }}</option>
      @endforeach
    
      </select>

      <label for="anime_image" class="form-label">Upload Image:</label>
      <input type="file" class="form-control" required value="{{ $animes->anime_image }}"name="anime_image">

      <label for="anime_description" class="form-label">Anime Description:</label>
      <textarea name="anime_description" class="form-control" id="" cols="30" rows="10">{{ $animes->anime_description }}</textarea>
   
   <label for="anime_type" class="form-label">Anime Type:</label>
   <select  class="form-select" name="anime_type" id="">
      <option value="TV">Tv</option>
      <option value="Ova">Ova</option>
      <option value="Movie">Movie</option>
   </select>

   <label for="anime_status" class="form-label">Anime Status:</label>
   <select  class="form-select" name="anime_status" id="">
      <option value="Currently Airing">Currently Airing</option>
      <option value="Finished Airing">Finished Airing</option>
   </select>

   <label for="anime_trailer" class="form-label">Anime Trailer:</label>
   <input type="text" class="form-control" name="anime_trailer" value="{{ $animes->anime_trailer }}"id="">

   <label for="anime_duration" class="form-label">Anime Duration:</label>
   <input type="text" class="form-control"  name="anime_duration" value="{{ $animes->anime_duration }}">

   <label for="anime_aired">Anime Aired:</label>
   <input type="date" class="form-control date" name="anime_aired" id="" value="{{ $animes->anime_aired }}">

   <label for="anime_score" class="form-label">Anime Score:</label>
   <input type="text" class="form-control" name="anime_score" value="{{ $animes->anime_score }}">

   <label for="anime_episode">Anime Episode:</label>
   <input type="text" class="form-control" name="anime_episode" value="{{ $animes->anime_episode }}">
<br>
   <button class="btn btn-success" type="submit">Update</button>
   </div>
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@endsection