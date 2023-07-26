@extends('adminlte::page')

@section('title', 'Edit Data Operato')

@section('content_header')
    <h1>Edit Data Operator</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Data Operator</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('dataoperator.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama" required
                        value="{{ $edit->nama }}">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="Username" placeholder="Username" required
                        value="{{ $edit->username }}">
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="Jabatan" required
                        value="{{ $edit->jabatan }}">
                </div>
                <div class="form-group">
                    <label>Bidang</label>
                    <input type="text" class="form-control" name="bidang" placeholder="Bidang" required
                        value="{{ $edit->bidang }}">
                </div>
                <div class="form-group">
                    <label>password</label>
                    <input type="text" class="form-control" name="password" required value="{{ $edit->password }}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop

