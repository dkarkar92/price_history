@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/stores/stores.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col">

                <div class="card">
                    <div class="card-body">
                        <table id="" class="table table-sm table-bordered table-striped">
                            <thead class="">
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone 1</th>
                                    <th>Phone 2</th>
                                    <th>Fax</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($stores as $key => $store)
                                <tr>
                                    <td>{{ $store->name }}</td>
                                    <td>
                                        <address>
                                            {{ $store->address_1 }}
                                            @if (!empty($store->address_2))
                                                {{ $store->address_2 }}
                                            @endif
                                            <br>
                                            {{ $store->city }} {{ $store->state }}, {{ $store->postal_code }}
                                        </address>
                                    </td>
                                    <td>{{ $store->phone_1 }}</td>
                                    <td>{{ $store->phone_2 }}</td>
                                    <td>{{ $store->fax_1 }}</td>
                                    <td>
                                        <a href="{{ action('StoreController@edit', ['id' => $store->id]) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row justify-content-md-center">
            <div class="col">
                <button type="button" id="add_store_btn" class="btn btn-primary btn-lg btn-block">Add Store</button>
            </div>
        </div>

        <hr>

        <div id="add_store_form" class="row justify-content-md-center">
            <div class="col">

                <form method="post" action="{{action('StoreController@store')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name">Store Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Maple Cleaners" required>
                    </div>

                    <div class="form-group">
                        <label for="address_1">Address 1</label>
                        <input type="text" class="form-control" id="address_1" name="address_1" placeholder="53 Washington Road" required>
                    </div>

                    <div class="form-group">
                        <label for="address_2">Address 2</label>
                        <input type="text" class="form-control" id="address_2" name="address_2" placeholder="Apartment 2">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Rockaway" required>
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state" name="state" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="07866" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/stores/stores.js') }}"></script>
@endsection