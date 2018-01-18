@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/users/users.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col">

                <h1>Users</h1>

                <table id="users_table" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Default Store</th>
                        <th>Activity Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($user_roles as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email  }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td>{{ $user->store_name }}</td>
                            <td>{{ $user->active_flg === 1 ? "Yes" : "No" }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <hr>

        <div class="row justify-content-md-center">
            <div class="col">

                <h1>Registrable Users</h1>

                <table id="registrable_table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <td>Store Name</td>
                            <td>Role Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allowed_user_emails as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->store_name  }}</td>
                                <td>{{ $user->role_name  }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrationModal">Add New User Registration</button>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="Registration Modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Registration Modal">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ action('UserController@addRegistrableUser') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="modal-body">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="registrant_email" class="col-form-label">Email:</label>
                                    <input type="email" class="form-control" id="registrant_email" name="registrant_email" required>
                                </div>
                                <div class="form-group">
                                    <label for="registrant_default_store" class="col-form-label">Default Store:</label>
                                    <select class="form-control" id="registrant_default_store" name="registrant_default_store" required>
                                        @foreach($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="registrant_role" class="col-form-label">Role:</label>
                                    <select class="form-control" id="registrant_role" name="registrant_role" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/users/users.js') }}"></script>
@endsection