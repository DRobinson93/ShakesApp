@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <all-shakes :authenticated="{{ json_encode(Auth::check()) }}" :shakes="{{ $shakes }}"/>
@endsection
