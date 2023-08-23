@can('view')


    @extends('adminlte::page')

    @section('title', 'Surat Masuk')

@section('content_header')
    <h1>Surat Masuk</h1>
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
        @foreach ($surat as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->asal_surat }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $row->tanggal_surat }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->tanggal_diterima }}</td>
                <td>{{ $row->catatan }}</td>
                <td>{{ $row->jenis }}</td>
                <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td>
                <td class="d-flex" style="justify-content: center">
                    @if ($row->tindakan == SELESAI)
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
                    @else
                        <button type="button" data-toggle="modal" data-target="#deleteSuratMasukModal"
                            data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                            title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#editmodal" data-id="{{ $row->id }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit Surat">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#editTindakan"
                            data-id="{{ $row->id }}"
                            class="btn btn-xs btn-default text-warning mx-1 shadow btn-edit-tindakan" title="Ajukan">
                            <i class="fa fa-lg fa-fw fa-solid fa-share"></i>
                        </button>
                    @endif

                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}

    @include('suratmasuk.delete')
    @include('suratmasuk.show')
    @include('suratmasuk.edit')
    @include('suratmasuk.edit_tindakan')
    @include('suratmasuk.create')
@stop
@section('js')
    <script>
        $(document).ready(function() {
            let suratId;

            // When the delete button in the modal is clicked, send an AJAX request to delete the operator
            $('#confirmDeleteBtn').on('click', function() {

                if (suratId) {
                    $.ajax({
                        type: 'POST',
                        url: `/suratmasuk/${suratId}`, // Replace with the actual delete route URL
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#deleteSuratMasukModal').modal('hide');
                            window.location.href = "{{ route('suratmasuk.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting operator:', error);
                            $('#deleteSuratMasukModal').modal('hide');
                        }
                    });
                }
            });

            // When the delete button in the table is clicked, store the operator ID to be deleted
            $('.btn-delete').on('click', function() {
                suratId = $(this).data('id');
            });



            $('.btn-edit-tindakan').click(function(e) {
                suratId = $(this).data('id');
            });

            const tindakanToString = (status) => {
                switch (status) {
                    case {{ ARSIP }}:
                        return "Arsip";
                    case {{ REVISI }}:
                        return "Revisi";
                    case {{ SELESAI }}:
                        return "Arsip";
                }
            }

            const tindakanToBadge = (status) => {
                switch (status) {
                    case {{ ARSIP }}:
                        return "success";
                    case {{ REVISI }}:
                        return "warning";
                    case {{ SELESAI }}:
                        return "success";
                }
            }


            $('.btn-detail').on('click', function(event) {
                var id = $(this).data('id');


                $.get(`suratmasuk/${id}`, function(data) {
                    $('#id').text(data.data.id);
                    $('#nomor_surat').text(data.data.nomor_surat);
                    $('#tanggal_surat').text(data.data.tanggal_surat);
                    $('#asal_surat').text(data.data.asal_surat);
                    $('#tanggal_masuk').text(data.data.tanggal_diterima);
                    $('#perihal').text(data.data.perihal);
                    $('#sifat').text(data.data.sifat);
                    $('.tindakan').addClass(`badge-${tindakanToBadge(data.data.tindakan)}`)
                    $('#tindakan').text(tindakanToString(data.data.tindakan));
                    $('#catatan').text(data.data.catatan);
                    $('#lampiran').text(`${data.data.lampiran} Lampiran`);
                    $('#file').text(data.data.file);
                });
            });

            //Handle Create Form Submit
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
                        window.location.href = '{{ route('suratmasuk.index') }}';
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
            $('.btn-edit').click(function(e) {
                suratId = $(this).data('id');

                const url = '{{ route('suratmasuk.edit', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#editNomorSurat').val(response.surat.nomor_surat);
                        $('#editTanggalSurat').val(response.surat.tanggal_surat);
                        $('#editTanggalTerima').val(response.surat.tanggal_diterima);
                        $('#editAsalSurat').val(response.surat.asal_surat);
                        $('#editPerihal').val(response.surat.perihal);
                        $('#editLampiran').val(response.surat.lampiran);
                        $('#editJenis').val(response.surat.jenis);
                        $('#editSifat').val(response.surat.sifat);
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching data');
                    }
                });
            })

            $('#editSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const suratId = $('.btn-edit').data('id');
                const form = $('#editForm');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratmasuk.update', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratmasuk.index') }}';
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

            //Handle Edit Tindakan
            $('#editTindakanSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#editTindakanForm');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratmasuk.updateTindakan', ':suratId') }}'.replace(':suratId',
                    suratId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false, // Don't process the data (already in FormData)
                    contentType: false, // Don't set content type (handled by FormData)
                    success: function(response) {
                        window.location.href = '{{ route('suratmasuk.index') }}';
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
@endcan
