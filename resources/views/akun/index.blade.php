@extends('template.app')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Daftar Akun</h1>
    @if (Session::get("success"))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::get("deleted"))
    <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
@endif
    <!-- Tombol Tambah Akun -->
    <a href="{{ route('akun.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>

    <!-- Tabel Daftar Akun -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $akn)
            <tr>
                <td>{{ $akn->name }}</td>
                <td>{{ $akn->email }}</td>
                <td>{{ $akn->role }}</td>
                <td>
                    <!-- Tindakan Edit dan Hapus -->
                    <a href="{{ route('akun.edit', $akn->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('akun.destroy', $akn->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pesan Jika Tidak Ada Akun -->
    @if ($user->isEmpty())
    <div class="alert alert-info mt-3">
        Tidak ada akun yang tersedia.
    </div>
    @endif
</div>

@endsection