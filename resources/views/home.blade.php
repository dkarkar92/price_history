<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Price History</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <link href="{!! asset('packages/pickadate.js-3.5.6/lib/themes/default.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('packages/pickadate.js-3.5.6/lib/themes/default.date.css') !!}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/r-2.2.1/datatables.min.css"/>
        <style>
            input[type=number] {
                -moz-appearance: textfield;
            }

            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <h1>Price History Manager</h1>

            <div class="row justify-content-md-center">

                <!-- <div class="col"></div> -->

                <div class="card">
                    <div class="card-body">
                        <div class="col">
                            <form method="post" action="{{action('PriceHistory@store')}}">

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>

                                <div class="form-group">
                                    <label for="price_1">Price 1</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input type="number" class="form-control" id="price_1" name="price_1" min="1" step="any">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price_2">Price 2</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input type="number" class="form-control" id="price_2" name="price_2" min="1" step="any">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
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
                                    <th>Price 1</th>
                                    <th>Price 2</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($price_history as $key => $value)
                                    <tr>
                                        <td>{{ $value->log_date }}</td>
                                        <td>${{ number_format($value->price_1, 2) }}</td>
                                        <td>${{ number_format($value->price_2, 2) }}</td>
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

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

        <script type="text/javascript" src="{!! asset('packages/pickadate.js-3.5.6/lib/picker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('packages/pickadate.js-3.5.6/lib/picker.date.js') !!}"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/r-2.2.1/datatables.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <script>
        $( document ).ready(function() {
            console.log( "ready!" );

            Date.prototype.toDateInputValue = (function() {
                var local = new Date(this);
                local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                return local.toJSON().slice(0,10);
            });

            $("#date").val(new Date().toDateInputValue());
            $('#date').pickadate();

            $('#price_history_table').DataTable({
                "pageLength": 10
            });

            $.ajax({
                method: "GET",
                url: "price_history/graph",
                dataType: 'json',
            }).done(function( data ) {
                    console.log("success");
                    console.log(data);
                    var formatted_date = [];

                    $.each(data.date, function( index, value ) {
                        formatted_date.push(moment(value).toDate());
                    });

                    console.log(data.price_1);
                    console.log(data.price_2);
                    console.log(formatted_date);

                    var ctx = document.getElementById("myChart").getContext('2d');
                    var timeFormat = 'MM/DD/YYYY';

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: "Price 1",
                                data: data.price_1,
                                backgroundColor: "#00baff",
                                borderColor: "#3e95cd",
                                fill: false
                            }, {
                                label: "Price 2",
                                data: data.price_2,
                                backgroundColor: "#ff4f62",
                                borderColor: "#c13b47",
                                fill: false
                            }],
                            labels: formatted_date,
                        },
                        options: {
                            responsive: true,
                            title:{
                                display:true,
                                text:"Price History Graph"
                            },
                            tooltips: {
                                /*position: position,*/
                                mode: 'index',
                                intersect: false,
                            },
                            scales: {
                                xAxes: [{
                                    type: "time",
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Date'
                                    },
                                    time: {
                                        unit: 'day',
                                        tooltipFormat: 'MMMM D YYYY'
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Dollars'
                                    }
                                }]
                            }
                        }
                    });
            }).fail(function( data ) {
                    console.log("error");
                    console.log('Error:', data);
            });

        });
        </script>
    </body>
</html>
