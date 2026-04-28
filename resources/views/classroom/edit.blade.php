@extends('layouts.admin')

@section('header', 'Edit Kelas')

@section('content')
    <div class="card">
            <form action="{{ url('classrooms/' . $classroom->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" class="form-control" name="name" value="{{ $classroom->name }}">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
@endsection