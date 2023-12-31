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
                        <td>{!! $row->nomor_surat !!}</td>
                        <td>{!! $row->tanggal_surat !!}</td>
                        <td>{!! $row->perihal !!}</td>
                        <td>{!! $row->tanggal_diterima !!}</td>
                        <td>{{ $row->tindakan == 0 ? 'Tidak Diteruskan' : 'Diteruskan' }}</td>
                        <td>{!! $row->status !!}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#edit" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

            </x-adminlte-datatable>
        </div>
    </div>

    <x-adminlte-modal id="edit" title="Tambah tindakan" theme="navy" icon="fas fa-solid fa-file-medical"
        size='lg' v-centered scrollable>

        <div class="card">
            <div class="card-body">
                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan" />
                </div>
                <div class="form-group">
                    <label>Tindakan</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="2" selected disabled>Pilih Tindakan</option>
                        <option value="0" >Koreksi kembali</option>
                        <option value="1">Tindak Lanjut ke Kepala DInas</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary btn-update">Simpan</button>
            </div>
        </div>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            let suratId

            if ($("#tindakan").val() === "0") {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function() {
                var selectedOption = $(this).val();

                if (selectedOption === "0") {
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

            $('.btn-update').on('click', function(event) {

                console.log(suratId);
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
                            window.location.href = "{{ route('home') }}"
                        },
                    })

                }
            });

            $('.btn-edit').on('click', function() {
                suratId = $(this).data('id')
            })
        })
    </script>
@stop
