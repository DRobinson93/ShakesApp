@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
	<div class="container">
	    <shake :shake="{{ $shake }}"/>
	</div>
}
}
@endsection
