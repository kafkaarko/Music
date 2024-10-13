@extends('template.app')
@section('content')
@foreach ($music as $ms)
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
                
            <!-- Gambar Musik -->
            <img src="{{ asset('storage/' . $ms->img) }}" alt="{{ $ms->name }}" class="img-fluid">

        </div>
        <div class="col-md-8">
            <!-- Nama Musik -->
            <h2>{{ $ms['name-music'] }}</h2>
            
            <!-- Artis -->
            <h4>Artist: {{ $ms->artist }}</h4>
            
            <!-- Genre -->
            <p><strong>Genre: </strong>{{ $ms->genre }}</p>
            
            <!-- Deskripsi -->
            <p><strong>Description: </strong>{{ $ms->description }}</p>
            
            <!-- Pendengar -->
            <p><strong>Pendengar: </strong>{{ $ms->pendengar }}</p>
            
            @if ($ms->audio)
                <audio controls>
                    <source src="{{ asset('storage/' . $ms->audio) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            @else
                <p>No audio file available</p>
            @endif
        </div>
    </div>
</div>
@endforeach
@endsection