@extends('adminlte::page')

@section('title', 'Surat Masuk')

@section('content_header')
    <h1>Surat Masuk</h1>
@stop

@section('content')
    <a class="btn btn-success mb-3" href="{{ route('suratmasuk.create') }}">Tambah</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Table Surat masuk Database --}}
    <x-adminlte-datatable id="table5" :heads="$heads">
        @foreach ($surat_masuk as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->alamat_surat !!}</td>
                <td>{!! $row->nomor_surat !!}</td>
                <td>{!! $row->tanggal_surat !!}</td>
                <td>{!! $row->perihal !!}</td>
                <td>{!! $row->tanggal_diterima !!}</td>
                <td>{!! $row->status === 0 ? 'Belum Disposisi' : 'Sudah Disposisi' !!}</td>
                <td>{!! $row->file !!}</td>
                <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
                    <td class="d-flex">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('suratmasuk.edit', $row->id) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        @can('delete', Post::class)
                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        @endcan

                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                    </td>
                </form>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}

    {{-- Modal View Surat Masuk --}}
    <x-adminlte-modal id="detailmodal" title="Detail" theme="navy" icon="fa fa-lg fa-fw fa-info-circle" size='lg'
        disable-animations>
        <!-- Modal content will be populated via JavaScript AJAX -->
    </x-adminlte-modal>
    {{-- End Modal View Surat Masuk --}}
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/suratmasuk.js') }}"></script>
@stop
