@extends('adminlte::page')

@section('title', 'Disposisi')

@section('content_header')
    <h1>Disposisi</h1>
@stop

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-success mb-3" href="{{ route('disposisi.create') }}">Tambah</a>

    <div class="pb-5">
        <x-adminlte-datatable id="table5" :heads="$heads">
            @foreach ($suratMasuk as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nomor_surat }}</td>
                    <td>{{ $row->alamat_surat }}</td>
                    <td>{{ $row->tanggal_surat }}</td>
                    <td>{{ $row->perihal }}</td>
                    <td>
                        @foreach ($row->disposisi as $disposisi)
                            {{ $disposisi->diteruskan_ke }}@if (!$loop->last)
                                ->
                            @endif
                        @endforeach
                    </td>
                    {{-- <td>{{ $row->suratMasuk->perihal }}</td>
                    <td>{{ $row->sifat }}</td>
                    <td>{{ $row->catatan }}</td>
                    <td>{{ $row->diteruskan_ke }}</td>
                    <td>{{ $row->id_user }}</td> --}}
                    <td class="d-flex">
                        <a href="{{ route('surat-masuk.edit', $row->id) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete"
                            data-toggle="modal" data-target="#deleteModal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>

                        {{-- <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a> --}}

                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>

    <x-adminlte-modal id="deleteModal" title="Hapus Akun" size="sm" theme="danger" icon="fas fa-trash" v-centered
        static-backdrop scrollable>
        <div>Anda yakin ingin menghapus operator ?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Batal" data-dismiss="modal" />
            <x-adminlte-button theme="danger" label="Hapus" id="confirmDeleteBtn" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            let disposisiIdToDelete;

            $('#confirmDeleteBtn').on('click', function() {

                if (disposisiIdToDelete) {
                    $.ajax({
                        type: 'POST',
                        url: `/disposisi/${disposisiIdToDelete}`,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            window.location.href = "{{ route('disposisi.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting disposisi:', error);
                        }
                    });
                }
            });

            $('.btn-delete').on('click', function() {
                disposisiIdToDelete = $(this).data('id');
            });
        });
    </script>
@stop
