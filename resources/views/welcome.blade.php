@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-3 font-weight-normal">
                Shakes
                <button class="float-right btn btn-info btn-sm" type="button"
                        data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-filter"></i>
                </button>
            </h1>
        </div>
        <div class="collapse pb-3" id="collapseExample">
            <div class="card card-body">
                <search-filters :limit_val="{{json_encode($limitVal)}}" :sort_val="{{json_encode($sortVal)}}" :authenticated_id="{{ Auth::check()? Auth::id() : '-1' }}"/>
            </div>
        </div>
    </div>
    <all-shakes :shakes="{{ $shakes }}"/>
@endsection
