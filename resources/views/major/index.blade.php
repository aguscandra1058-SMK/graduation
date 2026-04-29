@extends('layouts.admin')

@section('header', 'Daftar Jurusan')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('majors/create') }}" class="btn btn-primary">Tambah Jurusan</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="5%">No.</th>
                    <th width="85%">Jurusan</th>
                    <th width="10%">Aksi</th>
                </tr>
                @foreach ($majors as $key => $major)
                <tr>
                    <td>{{ $key + 1 }}.</td>
                    <td>{{ $major->name }}</td>
                    <td>
                        <a href="{{ url('majors/'.$major->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url('majors/' . $major->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table> 
        </div>
    </div>
@endsection