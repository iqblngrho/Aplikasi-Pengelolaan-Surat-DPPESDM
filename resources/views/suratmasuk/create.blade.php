@extends('adminlte::page')

@section('title', 'Tambah Surat Masuk')

@section('content_header')
    <h1>Tambah Surat Masuk</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Surat Masuk</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required
                        value="{{ old('nomor_surat') }}">
                </div>
                <div class="form-group">
                    <label>Alamat Surat</label>
                    <input type="text" class="form-control" name="alamat_surat" placeholder="Alamat Surat" required
                        value="{{ old('alamat_surat') }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal_surat" required
                        value="{{ old('tanggal_surat') }}">
                </div>
                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" class="form-control" name="perihal" placeholder="Perihal" required
                        value="{{ old('perihal') }}">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" required value="{{ old('file') }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="status" name="status" value="{{ old('status') }}">>
                        <option value="0">Belum Disposisi</option>
                        <option value="1">Sudah Disposisi</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
