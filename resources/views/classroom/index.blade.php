@extends('layouts.admin')

@section('header', 'Daftar Kelas')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('classrooms/create') }}" class="btn btn-primary">Tambah Kelas</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="5%">No.</th>
                    <th width="85%">Kelas</th>
                    <th width="10%">Aksi</th>
                </tr>
                @foreach ($classrooms as $key => $classroom)
                <tr>
                    <td>{{ $key + 1 }}.</td>
                    <td>{{ $classroom->name }}</td>
                    <td>
                        <a href="{{ url('classrooms/'.$classroom->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url('classrooms/' . $classroom->id) }}" method="POST" style="display: inline;">
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
