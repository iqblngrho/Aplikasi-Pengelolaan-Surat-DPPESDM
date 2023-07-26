@extends('adminlte::page')

@section('title', 'Profil')

@section('content_header')
    <x-adminlte-profile-widget name="User Name"/>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
