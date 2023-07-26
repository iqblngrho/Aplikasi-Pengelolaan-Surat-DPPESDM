@can('view posts', Post::class)
@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('content_header')
    <h1>Surat Keluar</h1>
@stop

@section('content')
<x-adminlte-datatable id="table5" :heads="$heads">
    @foreach($surat_masuk as $row)
        <tr>
            <td>{!! $row->id !!}</td>
            <td>{!! $row->alamat_surat !!}</td>
            <td>{!! $row->nomor_surat !!}</td>
            <td>{!! $row->tanggal_surat !!}</td>
            <td>{!! $row->perihal !!}</td>
            <td>{!! $row->tanggal_diterima !!}</td>
            <td>{!! $row->status === 0 ? 'Belum Disposisi':'Sudah Disposisi' !!}</td>
            <td>{!! $row->file !!}</td>
            <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
            <td class="d-flex">
                @csrf
                @method('DELETE')
                <a href="{{ route('suratmasuk.edit', $row->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
                    title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>
                @can('delete', Post::Class)


                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>
                @endcan
                <button type="button"  class="btn btn-xs btn-default text-success mx-1 shadow btn-detail" title="Detail"  data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                    <i class="fa fa-lg fa-fw fa-info-circle"></i>
                </button>
            </td>
        </form>
        </tr>
    @endforeach
</x-adminlte-datatable>
{{-- end Table Surat Masuk Database --}}
@stop
@endcan
