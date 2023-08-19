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
                                <button type="button" data-toggle="modal" data-target="#ajukanModal" data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow btn-ajukan font-weight-bold"
                                    title="Edit">
                                    <span>Ajukan</span>
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            @endrole
                            @role('Kepala Dinas')
                                <button type="button" data-toggle="modal" data-target="#bidangModal"
                                    data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow btn-bidang" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    @include('dashboard.ajukan_modal')
    @include('dashboard.tindakan_bidang_modal')
@stop

@section('js')
    <script>
        $(document).ready(function() {

            let suratId


            if ($("#tindakan").val() === "1") {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function() {
                var selectedOption = $(this).val();

                if (selectedOption === "1") {
                    $('#catatanContainer').show();
                } else {
                    $('#catatanContainer').hide();
                }
            });

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            // $('.btn-update').on('click', function (event) {
            //     var suratId = $(this).data('id');
            //     $.get(`suratmasuk/${suratId}`, function (data) {
            //         // Isi elemen-elemen HTML dengan data yang diambil dari server
            //         $('#id').html(data.data.id);
            //         $('#nomor_surat').html(data.data.nomor_surat);
            //         $('#tanggal_surat').html(data.data.tanggal_surat);
            //         $('#asal_surat').html(data.data.asal_surat);
            //         $('#tanggal_masuk').html(data.data.tanggal_diterima);
            //         $('#perihal').html(data.data.perihal);
            //         $('#jenis').html(data.data.jenis);
            //     });
            // });

            $('.btn-submit').on('click', function(event) {
                if (suratId) {
                    $.ajax({
                        type: 'POST',
                        url: `suratmasuk/${suratId}/tindakan`,
                        data: {
                            _method: 'PUT',
                            _token: '{{ csrf_token() }}',
                            tindakan: $('#tindakan').val(),
                            catatan: $('#catatan').val(),
                        },
                        success: function(response) {
                            // TindakanSurat setelah berhasil memperbarui data
                            window.location.href = "{{ route('dashboard') }}";
                        },
                    });
                }
            });

            $('.btn-submit-bidang').on('click', function(event) {
                if (suratId) {
                    $.ajax({
                        type: 'POST',
                        url: `disposisi`,
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_surat: suratId,
                            id_bidang: $('#bidang').val(),
                            catatan: $('#catatanBidang').val(),
                        },
                        success: function(response) {
                            if (suratId) {
                                $.ajax({
                                    type: 'POST',
                                    url: `suratmasuk/${suratId}/tindakan`,
                                    data: {
                                        _method: 'PUT',
                                        _token: '{{ csrf_token() }}',
                                        tindakan: 4,
                                    },
                                    success: function(response) {
                                        window.location.href =
                                            "{{ route('disposisi.index') }}";
                                    },
                                });
                            }
                        },
                    });
                }
            });

            $('.btn-ajukan').on('click', function() {
                suratId = $(this).data('id')

                if (suratId) {
                    $.ajax({
                        type: 'GET',
                        url: `suratmasuk/${suratId}`,
                        success: function(data) {
                            $('.id').html(data.data.id);
                            $('.nomor_surat').html(data.data.nomor_surat);
                            $('.tanggal_surat').html(data.data.tanggal_surat);
                            $('.asal_surat').html(data.data.asal_surat);
                            $('.tanggal_masuk').html(data.data.tanggal_diterima);
                            $('.perihal').html(data.data.perihal);
                            $('.jenis').html(data.data.jenis);
                        },
                    });
                }
            })

            $('.btn-bidang').on('click', function() {
                suratId = $(this).data('id')

                if (suratId) {
                    $.ajax({
                        type: 'GET',
                        url: `suratmasuk/${suratId}`,
                        success: function(data) {
                            $('.id').html(data.data.id);
                            $('.nomor_surat').html(data.data.nomor_surat);
                            $('.tanggal_surat').html(data.data.tanggal_surat);
                            $('.asal_surat').html(data.data.asal_surat);
                            $('.tanggal_masuk').html(data.data.tanggal_diterima);
                            $('.perihal').html(data.data.perihal);
                            $('.jenis').html(data.data.jenis);
                        },
                    });
                }

                $.ajax({
                    type: 'GET',
                    url: `bidang/all`,
                    success: function(data) {
                        const bidang = data.bidang
                        const selectElement = $('.bidang');

                        selectElement.empty();

                        // Populate the select element with options
                        bidang.forEach(function(item) {
                            selectElement.append($('<option>', {
                                value: item.id,
                                text: item.bidang
                            }));
                        });
                    },
                });
            })
        })
    </script>
    <script>
        {{-- document.getElementById("viewPdfButton").addEventListener("click", function () { --}}
        {{--    var pdfUrl = "{{ Storage::url($row->file) }}"; --}}
        {{--    var pdfViewer = document.getElementById("pdfViewer"); --}}
        {{--    pdfViewer.src = "https://docs.google.com/gview?url=" + encodeURIComponent(pdfUrl) + "&embedded=true"; --}}

        {{--    document.getElementById("pdfContainer").style.display = "block"; --}}
        {{-- }); --}}
    </script>
@stop
