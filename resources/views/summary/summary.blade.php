@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/summary/summary.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col">

                <div class="card">
                    <div class="card-body">

                        <h1>Summary</h1>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
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
                                        <tr>
                                            <td class="text-center">{{ $time_period }}</td>
                                            <td class="text-center">{{ $date_ranges[$time_period]['start'] }} <br> - <br> {{ $date_ranges[$time_period]['end'] }}</td>
                                            <td class="text-left">${{ is_null($data[0]->sum_cash) ? "0" : number_format($data[0]->sum_cash) }}</td>
                                            <td class="text-left">${{ is_null($data[0]->sum_credit) ? "0" : number_format($data[0]->sum_credit) }}</td>
                                            <td class="text-left">${{ number_format($data[0]->sum_cash + $data[0]->sum_credit) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/summary/summary.js') }}"></script>
@endsection
