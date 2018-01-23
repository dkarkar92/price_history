@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/summary/summary.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col">

                <h1>Summary</h1>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Interval</th>
                            <td>Dates</td>
                            <th>Cash</th>
                            <th>Credit</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($price_history as $time_period => $data)
                            <?php \Debugbar::info($data[0]->sum_cash ) ?>
                            <tr>
                                <td>{{ $time_period }}</td>
                                <td>{{ $date_ranges[$time_period]['start'] }} - {{ $date_ranges[$time_period]['end'] }}</td>
                                <td>${{ is_null($data[0]->sum_cash) ? "0" : $data[0]->sum_cash }}</td>
                                <td>${{ is_null($data[0]->sum_credit) ? "0" : $data[0]->sum_credit }}</td>
                                <td>${{ $data[0]->sum_cash + $data[0]->sum_credit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/summary/summary.js') }}"></script>
@endsection