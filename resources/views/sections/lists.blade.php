@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header">Lists available</div>
                <div class="card-body">
                    <table class="table table-hover">
                        @if (isset($lists))
                                @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        <a href="/list/{{ $list->id }}">{{ $list->name }}</a>
                                    </td>
                                </tr>
                                @endforeach
                        @else
                            <tr>
                                <td>No lists created</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Add lists</div>
                <div class="card-body">
                    <form action="/list" method="post">
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
