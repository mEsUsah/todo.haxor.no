@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header">Content</div>
                <div class="card-body">
                    <li>
                        <a href="/lists">Lists</a>
                    </li>
                    @if (Auth::user()->privilege_id == 2)
                        <li>
                            <a href="/users">Users</a>
                        </li>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
