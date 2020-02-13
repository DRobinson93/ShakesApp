@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <shake :shake="{{ $shake }}"/>
@endsection
