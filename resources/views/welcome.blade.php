@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <all-shakes :shakes="{{ $shakes }}"/>
@endsection
