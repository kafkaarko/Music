@extends('template.app')

@section('content')
<h1>edit Lagu</h1>
<form action="{{ route('music.update',$music['id']) }}" method="post" enctype="multipart/form-data"> <!-- Tambah enctype -->
    @csrf
    @method('PATCH')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nama Lagu</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $music['name-music'] }}">
    </div>
    <div class="mb-3">
        <label for="artist" class="form-label">Nama Artis</label>
        <input type="text" class="form-control" id="artist" name="artist" value="{{ $music['artist'] }}">
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" value="{{ $music['genre'] }}" >
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi Lagu</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ $music['description'] }}">
    </div>
    <div class="mb-3">
        <label for="pendengar" class="form-label">Pendengar</label> <!-- Perbaiki ID -->
        <input type="number" class="form-control" id="pendengar" name="pendengar" value="{{ $music['pendengar'] }}"> <!-- Konsistensi ID dan name -->
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Gambar Lagu</label>
        <input type="file" class="form-control" id="img" accept="image/*" name="img" value="{{  asset('storage/' . $music['img'])  }}" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
