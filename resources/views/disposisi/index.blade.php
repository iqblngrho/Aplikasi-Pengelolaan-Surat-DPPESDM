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
                    <button type="button" data-toggle="modal" data-target="#cetakModal"
                        class="btn btn-xs btn-default text-primary mx-1 shadow btn-terima-tindakan" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
    @include("disposisi.cetak")
@stop
@section('js')
<script>
    $('#terimaTindakanSubmitBtn').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const suratId = $('.btn-terima-tindakan').data('id');
            const form = $('#cetakForm');
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
                    window.location.href = '{{ route('disposisi.index') }}';
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
