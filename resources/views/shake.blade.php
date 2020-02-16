@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
	<div class="container">
	    <shake :authenticated="{{ json_encode(Auth::check()) }}" :shake="{{ $shake }}"/>
	</div>
@endsection
