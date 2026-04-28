@extends('layouts.admin')

@section('header', 'Tambah Jurusan')

@section('content')
    <div class="card">
            <form action="{{ url('majors') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan jurusan">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
@endsection