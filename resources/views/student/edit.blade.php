@extends('layouts.admin')

@section('header', 'Edit Siswa')

@section('content')
    <div class="card">
            <form action="{{ url('students/' . $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" class="form-control" name="nis" value="{{ $student->nis }}">
                    </div>
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" class="form-control" name="nisn" value="{{ $student->nisn }}">
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control" name="name" value="{{ $student->name }}">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="L" {{ $student->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $student->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="id_classroom">
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ $student->id_classroom == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" name="id_major">
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" {{ $student->id_major == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $student->status == 1 ? 'selected' : '' }}>Lulus</option>
                            <option value="0" {{ $student->status == 0 ? 'selected' : '' }}>Tidak Lulus</option>
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
@endsection