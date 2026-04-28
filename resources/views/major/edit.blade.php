@extends('layouts.admin')

@section('header', 'Edit Jurusan')

@section('content')
    <div class="card">
            <form action="{{ url('majors/' . $major->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="name" value="{{ $major->name }}">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
@endsection