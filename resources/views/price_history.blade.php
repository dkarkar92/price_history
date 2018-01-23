@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/price_history.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">

    <h1>{{ $store->name }}</h1>

    <hr>

    <div class="row justify-content-md-center">

        <!-- <div class="col"></div> -->

        <div class="card">
            <div class="card-body">
                <div class="col">
                    <form method="post" action="{{ action('PriceHistory@store') }}">

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>

                        <div class="form-group">
                            <label for="cash">Cash</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" id="cash" name="cash" min="1" step="any" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="credit_card">Credit Card</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" id="credit_card" name="credit_card" min="1" step="any" required>
                            </div>
                        </div>

                        <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div class="row justify-content-md-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="price_history_table" class="table table-sm table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Cash</th>
                            <th>Credit Card</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($price_history as $key => $value)
                            <tr>
                                <td>{{ $value->log_date }}</td>
                                <td>${{ number_format($value->cash, 2) }}</td>
                                <td>${{ number_format($value->credit_card, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" height="250" ></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/price_history.js') }}"></script>
@endsection