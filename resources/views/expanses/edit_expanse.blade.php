@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/price_history.css') !!}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<div class="container">


    <hr>

 <div class="row justify-content-center">

    <!-- <div class="col"></div> -->

    <div class="card">
        <div class="card-body">
            <div class="col">
                <form method="post" action="{{ action('ExpanseController@update', ['id' => $expanse->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('PUT') }}



                    <div class="form-group">
                        <label for="cash">Amount:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="amount" name="amount" min="1" step="any" value="{{ $expanse->amount }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_type" class="col-form-label">Payment Type:</label>
                        <select class="form-control" id="payment_type" name="payment_type" value="{{ $expanse->payment_type }}" required>
                                <option value="Cash">Cash</option>
                                <option value="Check">Check</option>
                                <option value="Credit">Credit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="credit_card">Description:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="description" name="description" step="any" value="{{ $expanse->description }}" required>
                        </div>
                    </div>

                    <button type="submit" id="submit_btn" class="btn btn-primary" onclick="return confirm('Are you sure you want to submit this item?')">Submit</button>

                </form>
            </div>
        </div>
    </div>

 </div>

</div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/expanse.js') }}"></script>
@endsection
