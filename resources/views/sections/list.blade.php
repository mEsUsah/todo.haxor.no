@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header">List items</div>
                <div class="card-body">
                    <ul>
                        @if (isset($tasks) && count($tasks))
                            @foreach ($tasks as $task)
                                <li>{{ $task->title }} {{ $task->complete == 1 ? "Completed" : "Pending"}}</li>
                            @endforeach
                        @else
                            <p>No tasks created</p>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Add task to this list</div>
                <div class="card-body">
                    <form action="/og/task" method="post">
                        @csrf
                        <input class="form-control" type="hidden" name="list" id="list" value="{{ $id }}">
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
