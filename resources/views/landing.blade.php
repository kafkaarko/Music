@extends('template.app')
@section('content')

<div class="container mt-5" >
    <h1>Selamat datang {{ Auth::User()->name }}</h1>

    <p>Mau dengar apa sekarang?? </p>
    <p>dengarkan beberapa music dari kami!!</p>
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
                <div class=" my-2">
                    <div class="card-body ">
                        <audio controls class="w-50">
                            <source src="{{ asset('storage/' . $ms->audio) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
                
                @else
                    <p>Admin tidak menambahkan satu music</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection