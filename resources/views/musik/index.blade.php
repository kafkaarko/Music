@extends('template.app')

@section('content')
@foreach ($music as $ms)
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
                
            <!-- Gambar Musik -->
            <img src="{{ asset('storage/' . $ms->img) }}" alt="error" class="img-fluid">

        </div>
        <div class="col-md-8">
            <!-- Nama Musik -->
            <h3>{{ $ms['name-music'] }}</h3>
            
            <!-- Artis -->
            <h4>Artist: {{ $ms->artist }}</h4>
            
            <!-- Genre -->
            <p><strong>Genre: </strong>{{ $ms->genre }}</p>
            
            <!-- Deskripsi -->
            <p><strong>Description: </strong>{{ $ms->description }}</p>
            
            <!-- Pendengar -->
            <p><strong>Pendengar: </strong>{{ $ms->pendengar }}</p>
            
            <!-- Tombol Aksi -->
        <a href="{{ route('music.edit',$ms['id']) }}" class="btn btn-primary">Edit</a>
           <form action="{{ route('music.destroy',$ms['id']) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
           </form>
        </div>
    </div>
</div>
@endforeach
@endsection