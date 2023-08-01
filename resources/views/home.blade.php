@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>0</h3>
                    <p>Surat Masuk Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('surat-masuk.index') }}" class="small-box-footer">
                    Total Keseluruhan Surat Masuk: {{ $totalSuratMasuk }}
                </a>
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
                    <h3>3</h3>
                    <p>Disposisi Surat Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Total Keseluruhan Disposisi: {{ $totalDisposisi }}
                </a>
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

    </div>

    <div>
        <x-adminlte-datatable id="table5" :heads="$heads">
            @forelse ($suratMasuk as $row)
                <tr>
                    <td> {{ $row->id }}</td>
                    <td> {{ $row->nomor_surat }}</td>
                    <td> {{ $row->alamat_surat }}</td>
                    <td> {{ $row->tanggal_surat }}</td>
                    <td> {{ $row->perihal }}</td>
                    <td> {{ $row->disposisi[0]->sifat }}</td>
                    <td> {{ $row->disposisi[0]->catatan }}</td>
                    <td>
                        {{ $row->disposisi[0]->diteruskan_ke }}

                    </td>
                    <td class="d-flex">
                        <a href="{{ route('disposisi.edit', $row->disposisi[0]->id) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete    " title="Delete"
                            data-toggle="modal" data-target="#deleteModal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>

                        <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                            title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
