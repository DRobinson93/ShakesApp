@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
	<div class="container">
	    <shake :authenticated_id="{{ Auth::id() }}" :shake="{{ $shake }}"
               :ingredients="{{ $shake->ingredients }}"
        />
	</div>
@endsection
