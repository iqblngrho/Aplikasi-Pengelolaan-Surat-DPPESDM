@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('content_header')
    <h1>Surat Keluar</h1>
@stop
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content')
    <div class="text-right" style="margin-top: -40px">
        <a class="btn btn-success mb-3 btn-tambah" data-toggle="modal" data-target="#tambahmodal">Tambah</a>
    </div>


    @if ($message = Session::get('message'))
        <x-adminlte-alert theme="success" title="Success">
            <p>{{ $message }}</p>
        </x-adminlte-alert>
    @endif

    {{-- Table Surat masuk Database --}}
    <x-adminlte-datatable id="table5" :heads="$heads" striped hoverable with-buttons>
        @foreach ($suratkeluar as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->catatan }}</td>
                <td>{{ $row->status }}</td>
                {{-- <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td> --}}
                <td class="d-flex">
                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                        <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary  mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-print"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#deleteSuratMasukModal"
                            data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                            title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
