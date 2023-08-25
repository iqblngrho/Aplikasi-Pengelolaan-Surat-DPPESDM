@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('content_header')
    <h1>Surat Keluar</h1>
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
        @foreach ($suratkeluar as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->catatan }}</td>
                <td>{{ $row->status }}</td>
                {{-- <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td> --}}
                <td class="d-flex">
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
                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
    {{-- end Table Surat Masuk Database --}}

    @include('suratkeluar.create')
@stop


@section('js')
<script>
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
</script>
@stop
