@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/stores/edit_store.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">

        <div id="edit_store_form" class="row justify-content-md-center">
            <div class="col">

                <form method="post" action="{{ action('StoreController@update', ['id' => $store->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name">Store Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Maple Cleaners" value="{{ $store->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address_1">Address 1</label>
                        <input type="text" class="form-control" id="address_1" name="address_1" placeholder="53 Washington Road" value="{{ $store->address_1 }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address_2">Address 2</label>
                        <input type="text" class="form-control" id="address_2" name="address_2" placeholder="Apartment 2" value="{{ $store->address_2 }}">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Rockaway" required value="{{ $store->city }}">
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state" name="state" value="{{ $store->state }}" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="07866" value="{{ $store->postal_code }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/stores/edit_store.js') }}"></script>
@endsection