@extends('adminlte::page')

@section('title', 'Surat Masuk')

@section('content_header')
    <h1>Surat Masuk</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content')
    <a class="btn btn-success mb-3 btn-tambah" href="{{ route('suratmasuk.create') }}" data-toggle="modal"
        data-target="#tambahmodal">Tambah</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Table Surat masuk Database --}}
    <x-adminlte-datatable id="table5" :heads="$heads" striped hoverable with-buttons>
        @foreach ($surat as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->asal_surat !!}</td>
                <td>{!! $row->nomor_surat !!}</td>
                <td>{!! $row->tanggal_surat !!}</td>
                <td>{!! $row->perihal !!}</td>
                <td>{!! $row->tanggal_diterima !!}</td>
                <td>{{ $row->tindakan == 0 ? 'Tidak Diteruskan' : 'Diteruskan' }}</td>
                <td>{{ $row->catatan }}</td>
                <td>{!! $row->status !!}</td>
                <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
                    <td class="d-flex">
                        @csrf
                        @method('DELETE')
                        @can('delete', Post::class)
                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        @endcan

                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#editmodal{{ $row->id }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#editTindakan{{ $row->id }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </td>
                </form>
            </tr>
            @include('suratmasuk.edit')
            @include('suratmasuk.edit_tindakan')
        @endforeach

    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}


    {{-- Modal View Surat Masuk --}}
    <x-adminlte-modal id="detailmodal" title="Detail" theme="navy" icon="fa fa-lg fa-fw fa-info-circle" size='lg'
        disable-animations>
        <table class="table">
            <tbody>
                <tr>
                    <th>No</th>
                    <td id="id"></td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td id="nomor_surat"></td>
                </tr>
                <tr>
                    <th>Tanggal Surat</th>
                    <td id="tanggal_surat"></td>
                </tr>
                <tr>
                    <th>Alamat Surat</th>
                    <td id="alamat_surat"></td>
                </tr>
                <tr>
                    <th>Tanggal Diterima</th>
                    <td id="tanggal_masuk"></td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td id="perihal"></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td id="status"></td>
                </tr>
                <tr>
                    <th>Lampiran</th>
                    <td id="lampiran"></td>
                </tr>
                <tr>
                    <th>Sifat</th>
                    <td id="sifat"></td>
                </tr>
                <tr>
                    <th>Tindakan</th>
                    <td id="tindakan"></td>
                </tr>
                <tr>
                    <th>File</th>
                    <td id="file"></td>
                </tr>
            </tbody>
        </table>
    </x-adminlte-modal>
    {{-- End Modal View Surat Masuk --}}

    @include('suratmasuk.create')

@stop
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-detail').on('click', function(event) {

                var id = $(this).data('id');

                $.get(`suratmasuk/${id}`, function(data) {
                    $('#id').html(data.data.id);
                    $('#nomor_surat').html(data.data.nomor_surat);
                    $('#tanggal_surat').html(data.data.tanggal_surat);
                    $('#alamat_surat').html(data.data.asal_surat);
                    $('#tanggal_masuk').html(data.data.tanggal_diterima);
                    $('#perihal').html(data.data.perihal);
                    $('#status').html(data.data.status);
                    $('#sifat').html(data.data.sifat);
                    $('#tindakan').html(data.data.tindakan);
                    $('#lampiran').html(data.data.lampiran);
                    $('#file').html(data.data.file);
                })
            });

        })
    </script>
@stop
