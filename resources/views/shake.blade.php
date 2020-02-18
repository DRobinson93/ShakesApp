@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
	<div class="container">
	    <shake :authenticated_id="{{ Auth::check()? Auth::id() : '-1' }}" :shake="{{ $shake }}"
               :ingredients="{{ $shake->ingredients }}"
        />
	</div>
@endsection
