

@php
$heads = [
    'No',
    'Alamat surat',
    'Nomor Surat',
    'Tanggal Surat',
    'Perihal',
    'Tanggal Diterima',
    'Status',
    'File',
    // ['label' => 'Phone', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align'=> 'center'],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';
@endphp
{{-- ------------------------------------------------------------------------------------ --}}

@extends('adminlte::page')

@section('title', 'Surat Masuk')



@section('content')
{{-- @hasanyrole('Kepala Bidang|admin') --}}
@can('view posts')
<h1>Surat Masuk</h1>
</div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero deserunt porro nostrum, itaque quidem error rerum sit laboriosam nihil vitae recusandae ad maiores facilis sint suscipit inventore unde minima. Aspernatur.</p>
    <a class="btn btn-success mb-3"  href="/suratmasuk/create">Tambah
    </a>
    @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

{{-- Table Surat masuk Database --}}
        <x-adminlte-datatable id="table5" :heads="$heads">
            @foreach($surat_masuk as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->alamat_surat !!}</td>
                    <td>{!! $row->nomor_surat !!}</td>
                    <td>{!! $row->tanggal_surat !!}</td>
                    <td>{!! $row->perihal !!}</td>
                    <td>{!! $row->tanggal_diterima !!}</td>
                    <td>{!! $row->status === 0 ? 'Belum Disposisi':'Sudah Disposisi' !!}</td>
                    <td>{!! $row->file !!}</td>
                    <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
                    <td class="d-flex">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('suratmasuk.edit', $row->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
                            title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        @can('delete', Post::Class)


                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                        @endcan
                        <button type="button"  class="btn btn-xs btn-default text-success mx-1 shadow btn-detail" title="Detail"  data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>
                    </td>
                </form>
                </tr>
            @endforeach
        </x-adminlte-datatable>
{{-- end Table Surat Masuk Database --}}

{{-- Modal View Surat Masuk --}}
<x-adminlte-modal id="detailmodal" title="Detail" theme="navy"
icon="fa fa-lg fa-fw fa-info-circle" size='lg' disable-animations>
<table class="table">
    <tbody>
        <tr>
            <th>No</th>
                <td id="id"></td>
        </tr>
        <tr>
            <th>Nomor Surat</th>
                <td id="nomor_surat"></td>
        </tr>
        <tr>
            <th>Alamat Surat</th>
                <td id="alamat_surat"></td>
        </tr>
        <tr>
            <th>Tanggal Surat</th>
                <td id="tanggal_surat"></td>
        </tr>
        <tr>
            <th>Perihal</th>
                <td id="perihal"></td>
        </tr>
        <tr>
            <th>Tanggal Terima</th>
                <td id="tanggal_diterima"></td>
        </tr>
        <tr>
            <th>Status</th>
                <td id="status"></td>
        </tr>
        <tr>
            <th>File</th>
                <td id="file"></td>
        </tr>
    </tbody>
</table>


</x-adminlte-modal>
{{-- End Modal View Surat Masuk --}}
@else
<h3>Tidak boleh</h3>
@endcan
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-detail').on('click', function(event) {

                event.preventDefault();
                var id = $(this).data('id');

                $.get(`/suratmasuk/${id}`, function(data) {
                    $('#id').html(data.data.id);
                    $('#nomor_surat').html(data.data.nomor_surat);
                    $('#alamat_surat').html(data.data.alamat_surat);
                    $('#tanggal_surat').html(data.data.tanggal_surat);
                    $('#tanggal_diterima').html(data.data.tanggal_diterima);
                    $('#perihal').html(data.data.perihal);
                    $('#status').html(data.data.status === 0 ? 'Belum Disposisi':'Sudah Disposisi');
                    $('#file').html(data.data.file);
                })
            });
        })
    </script>

@stop


