@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/stores/edit_store.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">

        <div id="show_store_form" class="row justify-content-md-center">
            <div class="col">

                <address>
                    <strong>{{ $store->name }}</strong>
                    <br>
                    {{ $store->address_1 }}
                    {{ $store->address_2 }}
                    <br>
                    {{ $store->city }}, {{ $store->state }} {{ $store->postal_code }}
                </address>

                <h4>Users that belong to {{ $store->name }}:</h4>
                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @foreach ($users as $user)

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="users_to_store" name="users_to_store">
                            <label class="form-check-label" for="users_to_store">{{ $user->name }}, {{ $user->email }}</label>
                            {{--@if ()
                            @endif--}}
                        </div>

                    @endforeach

                </form>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/stores/edit_store.js') }}"></script>
@endsection