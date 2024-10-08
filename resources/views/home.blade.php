@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header">Content</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>
                                <a href="/lists">Lists</a>
                            </td>
                        </tr>
                        @can('viewAny', App\Models\User::class)
                            <tr>
                                <td>
                                    <a href="/users">Users</a>
                                </td>
                            </tr>
                        @endcan
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
