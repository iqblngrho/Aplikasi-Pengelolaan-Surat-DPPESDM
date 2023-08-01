@extends('adminlte::page')

@section('title', 'Edit Disposisi')

@section('content_header')
    <h1>Edit Disposisi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Disposisi</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-body">
            <form action="{{ route('disposisi.update', $disposisi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Diteruskan ke</label>
                    <select class="form-control" id="role" name="diteruskan_ke">
                        @foreach ($roles as $role)
                            @if ($disposisi->diteruskan_ke != $role)
                                <option value="{{ $role }}">
                                    {{ $role }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required
                        value="{{ $surat->nomor_surat }}">
                </div>
                <div class="form-group">
                    <label>Alamat Surat</label>
                    <input type="text" class="form-control" name="alamat_surat" placeholder="Alamat Surat" required
                        value="{{ $surat->alamat_surat }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal_surat" required
                        value="{{ $surat->tanggal_surat }}">
                </div>
                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" class="form-control" name="perihal" placeholder="Perihal" required
                        value="{{ $surat->perihal }}">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" value="{{ $surat->file }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="status" name="status">>>
                        <option {{ $surat->status == 0 ? 'selected' : '' }} value="0">Belum Disposisi</option>
                        <option {{ $surat->status == 1 ? 'selected' : '' }}value="1">Sudah Disposisi</option>
                    </select>
                </div> --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
