@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content')
    <div class="row">

        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>jumlah</h3>
                    <p>Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/suratmasuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>jumlah</h3>
                    <p>Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>jumlah</h3>
                    <p>Disposisi Surat</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <x-adminlte-datatable id="table5" :heads="$heads" striped hoverable with-buttons>
                @foreach ($suratMasuk as $row)
                    <tr>
                        <td>{!! $row->id !!}</td>
                        <td>{!! $row->asal_surat !!}</td>
                        <td>{!! $row->perihal !!}</td>
                        <td>{!! $row->tanggal_diterima !!}</td>
                        <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td>
                        <td>
                            @role('sekretaris')
                            <button type="button" data-toggle="modal" data-target="#edit" data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow btn-update font-weight-bold"
                                    title="Edit">Ajukan
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            @endrole
                            @role('Kepala Dinas')
                            <button type="button" data-toggle="modal" data-target="#edit" data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            @endrole

                        </td>
                    </tr>
                @endforeach

            </x-adminlte-datatable>
        </div>
    </div>

    <x-adminlte-modal id="edit" title="Tambah tindakan" theme="navy" icon="fas fa-solid fa-file-medical"
                      size='lg' v-centered scrollable>
        <x-adminlte-card id="detailsurat" title="Detail Surat" theme="navy" icon="fas fa-lg fa-fan" collapsible>
            <table class="table table-sm">
                <tr>
                    <td>No</td>
                    <td id="id"></td>
                </tr>
                <tr>
                    <td>Asal Surat</td>
                    <td id="asal_surat"></td>
                </tr>
                <tr>
                    <td>Nomor Surat</td>
                    <td id="nomor_surat"></td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td>
                    <td id="tanggal_surat"></td>
                </tr>
                <tr>
                    <td>Perihal Surat</td>
                    <td id="perihal"></td>
                </tr>
                <tr>
                    <td>Tanggal Diterima</td>
                    <td id="tanggal_masuk"></td>
                </tr>
                <tr>
                    <td>Jenis</td>
                    <td id="jenis"></td>
                </tr>
                <tr>
                    <td>File</td>
                    <td class="d-flex">
                        <a type="application/pdf" href="{{ Storage::url($row->file) }}" target="_blank"
                           class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">Download
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a>
                        <button id="viewPdfButton" class="btn btn-xs btn-default text-primary mx-1 shadow"
                                title="Lihat File">Lihat PDF
                        </button>
                    </td>
                </tr>
            </table>
        </x-adminlte-card>

        <div class="card">
            <div class="card-body">
                <div id="pdfContainer" style="display: none;">
                    <iframe id="pdfViewer" style="width: 100%; height: 500px;"></iframe>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('suratmasuk.updateTindakan', $row->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group" id="catatanContainer">
                        <label>Catatan</label>
                        <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan"/>
                    </div>

                    <div class="form-group">
                        <label>TindakanSurat</label>
                        <select id="tindakan" class="form-control" name="tindakan">
                            <option value="" selected disabled>Pilih TindakanSurat</option>
                            <option value="{{ REVISI  }}">Koreksi kembali</option>
                            <option value="{{ TINDAK_LANJUT }}">Tindak Lanjut ke Kepala DInas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submitupdate">Simpan</button>
                </form>
            </div>
        </div>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function () {

            let suratId

            if ($("#tindakan").val() === 0) {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function () {
                var selectedOption = $(this).val();

                if (selectedOption === 0) {
                    $('#catatanContainer').show();
                } else {
                    $('#catatanContainer').hide();
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.btn-update').on('click', function (event) {
                var suratId = $(this).data('id');
                $.get(`suratmasuk/${suratId}`, function (data) {
                    // Isi elemen-elemen HTML dengan data yang diambil dari server
                    $('#id').html(data.data.id);
                    $('#nomor_surat').html(data.data.nomor_surat);
                    $('#tanggal_surat').html(data.data.tanggal_surat);
                    $('#asal_surat').html(data.data.asal_surat);
                    $('#tanggal_masuk').html(data.data.tanggal_diterima);
                    $('#perihal').html(data.data.perihal);
                    $('#jenis').html(data.data.jenis);
                });
            });

            // $('.btn-submitupdate').on('click', function(event) {
            //     if (suratId) {
            //         $.ajax({
            //             type: 'POST',
            //             url: `suratmasuk/${suratId}/tindakan`,
            //             data: {
            //                 _method: 'PUT',
            //                 _token: '{{ csrf_token() }}',
            //                 tindakan: $('#tindakan').val(),
            //                 catatan: $('#catatan').val(),
            //             },
            //             success: function(response) {
            //                 // TindakanSurat setelah berhasil memperbarui data
            //                 window.location.href = "{{ route('dashboard') }}";
            //             },
            //         });


            //     }
            // });

            $('.btn-edit').on('click', function () {
                suratId = $(this).data('id')
            })
        })
    </script>
    <script>
        document.getElementById("viewPdfButton").addEventListener("click", function () {
            var pdfUrl = "{{ Storage::url($row->file) }}";
            var pdfViewer = document.getElementById("pdfViewer");
            pdfViewer.src = "https://docs.google.com/gview?url=" + encodeURIComponent(pdfUrl) + "&embedded=true";

            document.getElementById("pdfContainer").style.display = "block";
        });
    </script>
@stop
