@extends('adminlte::page')

@section('title', 'Surat Masuk')

@section('content_header')
    <h1>Surat Masuk</h1>
@stop

@section('content')
    @role('admin')
        <a class="btn btn-success mb-3" href="{{ route('surat-masuk.create') }}">Tambah</a>
    @endrole

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Table Surat masuk Database --}}
    <div class="pb-5">
        <x-adminlte-datatable id="table5" :heads="$heads">
            @foreach ($surat_masuk as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->alamat_surat !!}</td>
                    <td>{!! $row->nomor_surat !!}</td>
                    <td>{!! $row->tanggal_surat !!}</td>
                    <td>{!! $row->perihal !!}</td>
                    <td>{!! $row->tanggal_diterima !!}</td>
                    <td>
                        @if ($row->status === 0)
                            <span class="badge badge-danger">Belum Disposisi</span>
                        @else
                            <span class="badge badge-success">Sudah Disposisi</span>
                        @endif
                    </td>
                    <td class="d-flex">
                        @role('admin')
                            <a href="{{ route('surat-masuk.edit', $row->id) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>

                            <button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete    " title="Delete"
                                data-toggle="modal" data-target="#deleteModal" data-id="{{ $row->id }}">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        @endrole

                        <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a>

                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
    {{-- end Table Surat Masuk Database --}}

    <x-adminlte-modal id="detailmodal" title="Detail" theme="navy" icon="fa fa-lg fa-fw fa-info-circle" size='lg'
        disable-animations>
    </x-adminlte-modal>

    <x-adminlte-modal id="deleteModal" title="Hapus Akun" size="sm" theme="danger" icon="fas fa-trash" v-centered
        static-backdrop scrollable>
        <div>Anda yakin ingin menghapus operator ?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Batal" data-dismiss="modal" />
            <x-adminlte-button theme="danger" label="Hapus" id="confirmDeleteBtn" />
        </x-slot>
    </x-adminlte-modal>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/suratmasuk.js') }}"></script>
    <script>
        $(document).ready(function() {
            let suratMasukIdToDelete;

            $('#confirmDeleteBtn').on('click', function() {

                if (suratMasukIdToDelete) {
                    $.ajax({
                        type: 'POST',
                        url: `/surat-masuk/${suratMasukIdToDelete}`,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            window.location.href = "{{ route('surat-masuk.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting surat masuk:', error);
                        }
                    });
                }
            });

            $('.btn-delete').on('click', function() {
                suratMasukIdToDelete = $(this).data('id');
            });
        });
    </script>
@stop
