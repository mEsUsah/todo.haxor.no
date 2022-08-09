@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header">Lists</div>
                <div class="card-body">
                    <ul>
                        @if (isset($lists))
                            @foreach ($lists as $list)
                                <li><a href="/list/{{ $list->id }}">{{ $list->name }}</a></li>
                            @endforeach
                        @else
                            <p>No lists created</p>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Add lists</div>
                <div class="card-body">
                    <form action="/lists" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Name</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add list</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
