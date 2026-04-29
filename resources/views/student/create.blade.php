@extends('layouts.admin')

@section('header', 'Tambah Siswa')

@section('content')
    <div class="card">
            <form action="{{ url('students') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" class="form-control" name="nis" maxlength="4" placeholder="Nomor Induk Siswa" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div> 
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" class="form-control" name="nisn" maxlength="10" placeholder="Nomor Induk Siswa Nasional" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan nama siswa" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="id_classroom">
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" name="id_major">
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Lulus</option>
                            <option value="0">Tidak Lulus</option>
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
@endsection