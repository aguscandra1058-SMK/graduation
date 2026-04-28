@extends('layouts.admin')

@section('header', 'Daftar Siswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('students/create') }}" class="btn btn-primary">Tambah Siswa</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="100px">No.</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Gender</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($students as $key => $student)
                <tr>
                    <td>{{ $key + 1 }}.</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        @if ($student->gender == 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </td>
                    <td>{{ $student->classroom->name }}</td>
                    <td>{{ $student->major->name }}</td>
                    <td>
                        @if ($student->status == 1)
                            <span class="badge badge-success">Lulus</span>
                        @else
                            <span class="badge badge-danger">Tidak Lulus</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('students/'.$student->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url('students/' . $student->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table> 
        </div>
    </div>
@endsection