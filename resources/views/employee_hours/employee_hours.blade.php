@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/employee_hours/employee_hours.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col col-sm col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body mx-auto">
                        <div class="form-group ">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>

                        <div class="">
                            <h4 class="text-center">
                                <span id="week_start"></span>
                                <br>
                                <span>to</span>
                                <br>
                                <span id="week_end"></span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @foreach($stores_to_user as $key => $value)

            <div class="row justify-content-center">
                <div class="col">

                    <div class="card">
                        <div class="card-body">

                            <h2>{{ $value->name }}</h2>

                            <form method="post" action="{{ action('EmployeeHoursController@store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="week_start_input" class="week_start_input" value="">

                                <div class="table-responsive">


                                <table id="" class="table table-sm table-bordered table-striped employees_table">
                                    <thead class="">
                                        <tr>
                                            <td>Employee Name</td>
                                            <td>Amount Paid</td>
                                            <td>Last Updated</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($employees as $employee_key => $employee_value)
                                            @if($employee_value->store_id == $value->id)

                                                <input type="hidden" name="employee_id[{{ $employee_value->id }}]" value="{{ $employee_value->id }}">

                                                <tr>
                                                    <td>{{ $employee_value->first_name }} {{ $employee_value->last_name }}</td>

                                                    <td>
                                                        <div class="input-group col col-sm-8 col-md-6 col-lg-6 custom-currency-input mx-auto">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text currencyAddOn">$</span>
                                                            </div>
                                                            @if (empty($hours_this_week) || empty($hours_this_week[$employee_value->id]))
                                                                <input type="number" class="form-control amount_paid" placeholder="" name="amount_paid[{{ $employee_value->id }}]" min="1" step="any" value="{{ $employee_value->weekly_pay_rate }}">
                                                            @else
                                                                <input type="number" class="form-control amount_paid" placeholder="" name="amount_paid[{{ $employee_value->id }}]" min="1" step="any" value="{{ $hours_this_week[$employee_value->id]->amount_paid }}">
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @if (empty($hours_this_week) || empty($hours_this_week[$employee_value->id]))
                                                            --
                                                        @else
                                                            {{ date("D, M jS Y", strtotime($hours_this_week[$employee_value->id]->updated_at)) }}
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary btn-block">Submit {{ $value->name }} Pay Record</button>

                                </div>

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
