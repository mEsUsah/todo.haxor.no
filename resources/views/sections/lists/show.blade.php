@extends('layouts.app')

@section('content')
<h1>{{ $list->name }}</h1>
<div id="todo" data-list-id="{{ $list->id }}"></div>
@endsection

@push('styles')
    <style>
        h1{
            text-align: center
        }
    </style>
@endpush