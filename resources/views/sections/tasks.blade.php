@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header">List items</div>
                <div class="card-body">
                    <ul>
                        @if (isset($tasks))
                            @foreach ($tasks as $task)
                                <li>{{ $task->list }}: {{ $task->title }}
                                    @if ($task->complete == 0)
                                        <form action="/task/{{ $task->id }}/edit" method="post">
                                            @csrf
                                            <input type="hidden" type="number" name="complete" value="1">
                                            <button class="btn btn-success">complete</button>
                                        </form>
                                    @else
                                        <form action="/task/{{ $task->id }}/edit" method="post">
                                            @csrf
                                            <input type="hidden" type="number" name="complete" value="0">
                                            <button class="btn btn-danger">uncomplete</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        @else
                            <p>No tasks created</p>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Add task</div>
                <div class="card-body">
                    <form action="/task" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Name</label>
                            <input class="form-control" type="text" name="title" id="title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="list">List</label>
                            <input class="form-control" type="number" name="list" id="list">
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
