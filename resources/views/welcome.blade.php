@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <all-shakes :authenticatedId="{{ json_encode(Auth::id()) }}" :shakes="{{ $shakes }}"/>
@endsection
