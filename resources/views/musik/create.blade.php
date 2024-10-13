@extends('template.app')

@section('content')
<h1>Tambah Lagu</h1>
<form action="{{ route('music.store') }}" method="post" enctype="multipart/form-data"> <!-- Tambah enctype -->
    @csrf
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
        <input type="text" class="form-control" id="name" name="name" >
    </div>
    <div class="mb-3">
        <label for="artist" class="form-label">Nama Artis</label>
        <input type="text" class="form-control" id="artist" name="artist" >
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" >
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi Lagu</label>
        <input type="text" class="form-control" id="description" name="description">
    </div>
    <div class="mb-3">
        <label for="pendengar" class="form-label">Pendengar</label> <!-- Perbaiki ID -->
        <input type="number" class="form-control" id="pendengar" name="pendengar"> <!-- Konsistensi ID dan name -->
    </div>
    <div class="mb-3">
        <label for="audio" class="form-label">File Lagu (Audio)</label>
        <input type="file" class="form-control" id="audio" name="audio" accept="audio/*">
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Gambar Lagu</label>
        <input type="file" class="form-control" id="img" accept="image/*" name="img" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
