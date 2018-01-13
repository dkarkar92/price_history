@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/stores/stores.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col">

                <h1>Users</h1>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <td>Email</td>
                        <th>Role</th>
                        <th>Default Store</th>
                        <th>Activity Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email  }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/stores/stores.js') }}"></script>
@endsection