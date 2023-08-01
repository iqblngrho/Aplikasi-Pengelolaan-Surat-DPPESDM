@extends('adminlte::page')

@section('title', 'Bidang')

@section('content_header')
    <h1>Bidang</h1>
@stop

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-success mb-3" href="{{ route('bidang.create') }}">Tambah</a>

    <div class="pb-5">
        <x-adminlte-datatable id="table5" :heads="$heads">
            @foreach ($bidang as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td class="d-flex">
                        <a href="{{ route('bidang.edit', $row->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
                            title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete"
                            data-toggle="modal" data-target="#deleteModal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>

    <x-adminlte-modal id="deleteModal" title="Hapus Bidang" size="sm" theme="danger" icon="fas fa-trash" v-centered
        static-backdrop scrollable>
        <div>Anda yakin ingin menghapus bidang ?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Batal" data-dismiss="modal" />
            <x-adminlte-button theme="danger" label="Hapus" id="confirmDeleteBtn" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            let bdaingIdToDelete;

            $('#confirmDeleteBtn').on('click', function() {

                if (bdaingIdToDelete) {
                    $.ajax({
                        type: 'POST',
                        url: `/bidang/${bdaingIdToDelete}`,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            window.location.href = "{{ route('bidang.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting bidang:', error);
                        }
                    });
                }
            });

            $('.btn-delete').on('click', function() {
                bdaingIdToDelete = $(this).data('id');
            });
        });
    </script>
@stop
