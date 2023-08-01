@extends('adminlte::page')

@section('title', 'Tambah Disposisi')

@section('content_header')
    <h1>Tambah Disposisi</h1>
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
            <h3 class="card-title">Form Tambah Disposisi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Surat Masuk</label>
                    <select class="form-control" name="id_surat" value="{{ old('id_surat') }}">>
                        @foreach ($suratMasuk as $surat)
                            <option value="{{ $surat->id }}">{{ $surat->nomor_surat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Sifat</label>
                    <input type="text" class="form-control" name="sifat" placeholder="Sifat" required
                        value="{{ old('alamat_surat') }}">
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <input type="text" class="form-control" name="catatan" placeholder="Catatan" required
                        value="{{ old('catatan') }}">
                </div>

                <div class="form-group">
                    <label>Diteruskan ke</label>
                    <select class="form-control" id="role" name="diteruskan_ke">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" required value="{{ old('file') }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
