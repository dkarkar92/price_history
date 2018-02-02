@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/employees/employees.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">

        @foreach($stores_to_user as $key => $value)

            <h2>{{ $value->name }}</h2>

            <div class="row justify-content-center">
                <div class="col">

                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="" class="table table-sm table-bordered table-striped employees_table">
                                    <thead class="">
                                        <tr>
                                            <td>Employee Name</td>
                                            <td>Weekly Pay Rate</td>
                                            <td>Payment Type</td>
                                            <td>Role</td>
                                            <!-- <td>Action</td> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee_key => $employee_value)
                                            @if($employee_value->store_id == $value->id)
                                                <tr>
                                                    <td>{{ $employee_value->first_name }} {{ $employee_value->last_name }}</td>
                                                    <td>${{ $employee_value->weekly_pay_rate }}</td>
                                                    <td>{{ $employee_value->default_payment_type }}</td>
                                                    <td>{{ ucfirst($employee_value->role_name) }}</td>
                                                    <!-- <td><button class="btn btn-danger btn-sm">Delete</button></td> -->
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <br>
            <br>

        @endforeach

        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#newEmployeeModal">Add New Employee</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="New Employee Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="New Employee Modal">New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ action('EmployeeController@store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="first_name" class="col-form-label">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="col-form-label">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>

                            <div class="form-group">
                                <label for="weekly_pay_rate" class="col-form-label">Weekly Pay Rate:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" id="weekly_pay_rate" name="weekly_pay_rate" min="1" step="any" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default_payment_type" class="col-form-label">Payment Type:</label>
                                <select class="form-control" id="default_payment_type" name="default_payment_type" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit">Credit</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="employee_store" class="col-form-label">Store:</label>
                                <select class="form-control" id="employee_store" name="employee_store" required>
                                    @foreach($stores_to_user as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="employee_role" class="col-form-label">Role:</label>
                                <select class="form-control" id="employee_role" name="employee_role" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/employees/employees.js') }}"></script>
@endsection
