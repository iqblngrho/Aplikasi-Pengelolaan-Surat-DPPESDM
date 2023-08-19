@extends('adminlte::page')

@section('title', 'Surat Masuk')

@section('content_header')
    <h1>Surat Masuk</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content')
    <a class="btn btn-success mb-3 btn-tambah" data-toggle="modal" data-target="#tambahmodal">Tambah</a>

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
                <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
                    <td class="d-flex">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#editmodal" data-id="{{ $row->id }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#editTindakan"
                            data-id="{{ $row->id }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit-tindakan" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </td>
                </form>
            </tr>
        @endforeach

    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}
    @include('suratmasuk.show')
    @include('suratmasuk.edit')
    @include('suratmasuk.edit_tindakan')
    @include('suratmasuk.create')
@stop
@section('js')
    <script>
        $(document).ready(function() {
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

            //Handle Edit Surat
            $('.btn-edit').click(function(e) {
                const suratId = $(this).data('id');

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
                const suratId = $('.btn-edit-tindakan').data('id');
                console.log(suratId);
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
                    $('#id').text(data.data.id);
                    $('#nomor_surat').text(data.data.nomor_surat);
                    $('#tanggal_surat').text(data.data.tanggal_surat);
                    $('#asal_surat').text(data.data.asal_surat);
                    $('#tanggal_masuk').text(data.data.tanggal_diterima);
                    $('#perihal').text(data.data.perihal);
                    $('#sifat').text(data.data.sifat);
                    $('#tindakan').text(data.data.tindakan);
                    $('#catatan').text(data.data.catatan);
                    $('#lampiran').text(data.data.lampiran);
                    $('#file').text(data.data.file);
                });
            });


        })
    </script>
@stop
