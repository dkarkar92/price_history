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
    </head>
    <body>

        <div class="container">
            <h1>Price History Manager</h1>

            <div class="row justify-content-md-center">

                <!-- <div class="col"></div> -->

                <div class="col">
                    <form method="post" action="{{url('home')}}">

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>

                        <div class="form-group">
                            <label for="price_1">Price 1</label>
                            <input type="number" class="form-control" id="price_1" name="price_1">
                        </div>

                        <div class="form-group">
                            <label for="price_2">Price 2</label>
                            <input type="number" class="form-control" id="price_2" name="price_2">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>

                <!-- <div class="col"></div> -->

            </div>
        </div>        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

        <script type="text/javascript" src="{!! asset('packages/pickadate.js-3.5.6/lib/picker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('packages/pickadate.js-3.5.6/lib/picker.date.js') !!}"></script>
        <script>
        $( document ).ready(function() {
            console.log( "ready!" );
            $('#date').pickadate()
        });
        </script>
    </body>
</html>
