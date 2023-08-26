@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('content_header')
    <h1>Surat Keluar</h1>
@stop
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content')
@role('admin')
    <div class="text-right" style="margin-top: -40px">
        <a class="btn btn-success mb-3 btn-tambah" data-toggle="modal" data-target="#tambahmodal">Tambah</a>
    </div>
@endrole


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
                <td>{{ $row->bidang->bidang }}</td>
                {{-- <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td> --}}
                <td class="d-flex">
                    <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail" title="Detail"
                        data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                        <i class="fa fa-lg fa-fw fa-info-circle"></i>
                    </button>
                    <a href="{{ Storage::url($row->file) }}" target="_blank"
                        class="btn btn-xs btn-default text-primary  mx-1 shadow" title="Lihat File">
                        <i class="fa fa-lg fa-fw fa-print"></i>
                    </a>
                    @role('admin')
                    <button type="button" data-toggle="modal" data-target="#editmodalSK" data-id="{{ $row->id }}"
                        class="btn btn-xs btn-default text-primary mx-1 shadow btn-editSK" title="Edit Surat">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#deleteSuratKeluarModal"
                        data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                        title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                    @endrole
                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}

    @include('suratkeluar.create')
    @include('suratkeluar.edit')
    @include('suratkeluar.delete')
@stop


@section('js')
    <script>
        $(document).ready(function() {
            let suratkeluarId;
             // When the delete button in the modal is clicked, send an AJAX request to delete the operator
             $('#confirmDeleteBtn').on('click', function() {
                if (suratkeluarId) {
                    $.ajax({
                        type: 'POST',
                        url: `/suratkeluar/${suratkeluarId}`, // Replace with the actual delete route URL
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#deleteSuratKeluarModal').modal('hide');
                            window.location.href = "{{ route('suratkeluar.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting operator:', error);
                            $('#deleteSuratKeluarModal').modal('hide');
                        }
                    });
                }
            });

            // When the delete button in the table is clicked, store the operator ID to be deleted
            $('.btn-delete').on('click', function() {
                suratkeluarId = $(this).data('id');
            });

            $('#createSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#createForm');
                const formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratkeluar.index') }}';
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            const errors = JSON.parse(xhr.responseText)

                            // Clear previous error messages
                            $('.invalid-feedback').empty();
                            $('.is-invalid').removeClass('is-invalid');

                            // Iterate through each error and display next to the input
                            $.each(errors, function(field, messages) {
                                const input = $('[name="' + field + '"]');
                                const errorContainer = input.siblings(
                                    '.invalid-feedback');
                                errorContainer.text(messages[0]);
                                input.addClass('is-invalid');
                            });
                        } else {
                            alert('Terjadi kesalahan pada server!');
                        }
                    }
                });
            });
            //Handle Edit SuratÏ
            $('.btn-editSK').click(function(e) {
                suratkeluarId = $(this).data('id');

                const url = '{{ route('suratkeluar.edit', ':suratkeluarId') }}'.replace(':suratkeluarId',suratkeluarId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#editNomorSuratKeluar').val(response.suratkeluar.nomor_surat);
                        $('#editTanggalSuratKeluar').val(response.suratkeluar.tanggal_surat);
                        $('#editAlamatTujuanSuratKeluar').val(response.suratkeluar.alamat_tujuan);
                        $('#editSifatSuratKeluar').val(response.suratkeluar.sifat);
                        $('#editBidangSuratKeluar').val(response.suratkeluar.id_bidang);
                        $('#editLampiranSuratKeluar').val(response.suratkeluar.lampiran);
                        $('#editPerihalSuratKeluar').val(response.suratkeluar.perihal);
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching data');
                    }
                });
            })

            $('#editSubmitBtnSK').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                const form = $('#editFormSK');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratkeluar.update', ':suratkeluarId') }}'.replace(':suratkeluarId',suratkeluarId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratkeluar.index') }}';
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            const errors = JSON.parse(xhr.responseText)

                            // Clear previous error messages
                            $('.invalid-feedback').empty();
                            $('.is-invalid').removeClass('is-invalid');

                            // Iterate through each error and display next to the input
                            $.each(errors, function(field, messages) {
                                const input = $('[name="' + field + '"]');
                                const errorContainer = input.siblings(
                                    '.invalid-feedback');
                                errorContainer.text(messages[0]);
                                input.addClass('is-invalid');
                            });
                        } else {
                            alert('Terjadi kesalahan pada server!');
                        }
                    }
                });
            });
        })
    </script>
@stop
