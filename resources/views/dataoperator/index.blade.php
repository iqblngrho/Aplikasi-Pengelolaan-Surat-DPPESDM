@php
$heads = [
    'No',
    'Nama',
    'Username',
    'Jabatan',
    'bidang',
    'Password',

    // ['label' => 'Phone', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align'=> 'center'],
];
@endphp
@can('view posts', Post::class)

@extends('adminlte::page')

@section('title', 'dataoperator')

@section('content_header')
    <h1>Data Operator</h1>
@stop

@section('content')
<x-adminlte-datatable id="table5" :heads="$heads">
    @foreach($dataoperator as $row)
        <tr>
            <td>{!! $row->id !!}</td>
            <td>{!! $row->nama !!}</td>
            <td>{!! $row->username !!}</td>
            <td>{!! $row->jabatan !!}</td>
            <td>{!! $row->bidang !!}</td>
            <td>{!! $row->password !!}</td>

            <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
            <td class="d-flex">
                @csrf
                @method('DELETE')
                <a href="{{ route('dataoperator.edit', $row->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
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
@stop
@endcan
