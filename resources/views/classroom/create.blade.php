@extends('layouts.admin')

@section('header', 'Tambah Kelas')

@section('content')
    <div class="card">
            <form action="{{ url('classrooms') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan kelas">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
@endsection