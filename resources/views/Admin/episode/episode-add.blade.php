@extends('layouts.admin-header')
@section('content')
<div class="card">
   <div class="card-header">Add New Episode</div>
   <div class="card-body">
<form method="POST" action="{{ url('episode') }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
      <label for="episode_title" class="form-label">Episode Title:</label>
      <input type="text" name="episode_title" required  class="form-control" id="episode_title" placeholder="Exemple: Episode 1">
      
      <label for="anime_id" class="form-label">Anime:</label>

      <select required class="form-select" aria-label="Default select example" name="anime_id" id="anime_id">
         @foreach($episodes as $anime)
         <option value="{{ $anime->anime_id }}">{{ $anime->anime_title }}</option>
        @endforeach
      </select>

      <label for="anime_id" class="form-label">Anime:</label>

    <select required class="form-select" aria-label="Default select example" name="anime_title" id="anime_title">
    @foreach($episodes as $anime)
    <option value="{{ $anime->anime_title }}">{{ $anime->anime_title }}</option>
    @endforeach
    </select>

<br>
   <button class="btn btn-success" type="submit">Add Episode</button>
   </div>
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@endsection