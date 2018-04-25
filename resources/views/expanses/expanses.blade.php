@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/price_history.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">

    <h1>

        @if($stores_to_user->isNotEmpty())
            <select id="main_store_select" name="main_store_select">
            @foreach ($stores_to_user as $key => $value)
                @if ($store->id == $value->id)
                    <option value="{{ $value->id }}" selected data-url="{{ action('expanseController@show', ['id' => $value->id]) }}">{{ $value->name }}</option>
                @else
                    <option value="{{ $value->id }}" data-url="{{ action('expanseController@show', ['id' => $value->id]) }}">{{ $value->name }}</option>
                @endif
            @endforeach
            </select>
        @else
            {{ $store->name }}
        @endif

    </h1>

    <hr>

    <div class="row justify-content-center">

        <!-- <div class="col"></div> -->

        <div class="card">
            <div class="card-body">
                <div class="col">
                    <form method="post" action="{{ action('ExpanseController@store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="store_id" value="{{ $store->id }}">

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" data-url="{{ action('ExpanseController@getExpanseDataForDay') }}">
                        </div>

                        <div class="form-group">
                            <label for="cash">Amount:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" step="any" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_type" class="col-form-label">Payment Type:</label>
                            <select class="form-control" id="payment_type" name="payment_type" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Check">Check</option>
                                    <option value="Credit">Credit</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="credit_card">Description:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="description" name="description" step="any" required>
                            </div>
                        </div>

                        <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="expanses_table" class="table table-sm table-bordered table-striped">
                        <thead class="">
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($expanses as $key => $value)
                            <tr>
                                <td>{{ $value->log_date }}</td>
                                <td>${{ number_format($value->amount, 2) }}</td>
                                <td>{{ $value->payment_type }}</td>
                                <td>{{ $value->description }}</td>
                                <td>
                                  <a class="btn btn-primary btn-sm" href="{{ action('ExpanseController@edit', ['id' => $value->id]) }}" role="button">Edit</a>

                                    <form  method="POST" class="pull-right" action="{{ action('ExpanseController@destroy', ['id' => $value->id]) }}">
                                      {{ csrf_field() }}
                                      {{ method_field('DELETE') }}
                                      <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/expanse.js') }}"></script>
@endsection
