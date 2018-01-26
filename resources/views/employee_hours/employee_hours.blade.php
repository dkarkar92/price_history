@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/employee_hours/employee_hours.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">

        <pre>
            <?php
                print_r($hours_this_week);
//                 $hours_this_week[$employee_value->id]->amount_paid === false ?   "" : $hours_this_week['$employee_value->id']->amount_paid
//
// {{ !is_null($hours_this_week[$employee_value->id]) ? $hours_this_week[$employee_value->id]->amount_paid : $employee_value->weekly_pay_rate  }}
             ?>
        </pre>

        <div class="row justify-content-md-center">
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group col-sm">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>

                        <div class="">
                            <h4>
                                <span id="week_start"></span> to <span id="week_end"></span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @foreach($stores_to_user as $key => $value)

            <div class="row justify-content-md-center">
                <div class="col-sm">

                    <div class="card">
                        <div class="card-body">

                            <h2>{{ $value->name }}</h2>

                            <form method="post" action="{{ action('EmployeeHoursController@store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="week_start_input" id="week_start_input" value="">

                                <table id="" class="table table-sm table-bordered table-striped employees_table">
                                    <thead class="">
                                        <tr>
                                            <td>Employee Name</td>
                                            <td>Amount Paid</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($employees as $employee_key => $employee_value)
                                            @if($employee_value->store_id == $value->id)
                                                <input type="hidden" name="employee_id[{{ $employee_value->id }}]" value="{{ $employee_value->id }}">

                                                <tr>
                                                    <td>{{ $employee_value->first_name }} {{ $employee_value->last_name }}</td>

                                                    <td>
                                                        <div class="input-group mb-3 col-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" class="form-control amount_paid" placeholder="Username" name="amount_paid[{{ $employee_value->id }}]" value="">
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary">Submit {{ $value->name }} Pay Record</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

            <br>
            <br>

        @endforeach

    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/employee_hours/employee_hours.js') }}"></script>
@endsection
