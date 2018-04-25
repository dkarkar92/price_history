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
                <form method="post" action="{{ action('PriceHistoryController@update', ['id' => $price_history->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('PUT') }}



                    <div class="form-group">
                        <label for="cash">Cash:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="amount" name="amount" min="1" step="any" value="{{ $price_history->cash }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cash">Credit Card:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="amount" name="amount" min="1" step="any" value="{{ $price_history->credit_card }}" required>
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
    <script src="{{ asset('js/price_history.js') }}"></script>
@endsection
