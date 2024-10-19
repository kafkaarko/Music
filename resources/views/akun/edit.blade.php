@extends('template.app')

@section('content')
<h1>Edit Lagu</h1>
<form action="{{ route('akun.update',$user['id']) }}" method="post" enctype="multipart/form-data"> <!-- Tambah enctype -->
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
        <label for="name" class="form-label">Nama Akun</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user['name']  }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
    </div>
    <div class="mb-3">
        <label for="password" class="fo rm-label">password</label>
        <input type="text" class="form-control" id="password" name="password" value="{{ $user['password'] }}">
    </div>
    <div class="mb-3 row">
        <label for="role" class="col-sm-2-col-form-label">Role : </label>
        <div class="col-sm-10">
            <select name="role" id="name" class="form-select">
                <option selected disabled hidden>pilih</option>
                <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>admin</option>
                <option value="user" {{ $user['role'] == 'user' ? 'selected' : '' }}>user</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="img" accept="image/*" name="img" >
        <img src="{{ asset('storage/' . $user->img) }}" alt="{{ $user->name }}" class="img-fluid" height="20%">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection