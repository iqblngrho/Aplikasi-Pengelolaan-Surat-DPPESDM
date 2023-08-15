    @extends('adminlte::page')

    @section('title', 'Disposisi')
@section('content_header')
    <h1>Disposisi</h1>
@stop
    @section('plugins.DatatablesPlugin', true)
    @section('plugins.Datatables', true)

@section('content')
    <x-adminlte-datatable id="table5" :heads="$heads" striped hoverable with-buttons>
        @foreach ($disposisi as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->surat_masuk->nomor_surat !!}</td>
                <td>{!! $row->surat_masuk->perihal !!}</td>
                <td>{!! $row->surat_masuk->asal_surat !!}</td>
                <td>{!! $row->catatan !!}</td>
                <td>{!! $row->bidang->bidang !!}</td>
                <td class="d-flex">
                    <button type="button" data-toggle="modal" data-target="#editmodal{{ $row->id }}"
                        class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
