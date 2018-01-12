@extends('layouts.app')

@section('custom-css')
    <link href="{!! asset('css/stores/show_store.css') !!}" rel="stylesheet" type="text/css" />
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
                <form method="post" action="{{ action('StoreController@addUserToStore', ['store_id' => $store->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Belongs To Store</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <?php
                                        $belongs_to_store = false;
                                        if (array_key_exists($user->email, $users_in_store)) {
                                            $belongs_to_store = true;
                                        }
                                ?>
                                <tr class="{{ $belongs_to_store === true ? " table-success " : " " }}">
                                    <td>
                                        {{--{{ $user->id }} ---}}
                                        <input type="checkbox" value="{{ $user->id }}" class="users_to_store" name="users_to_store[{{ $user->id }}]" {{ $belongs_to_store === true ? "checked" : "" }}>
                                        @if($belongs_to_store === true)
                                            <input type="hidden" value="{{ $belongs_to_store === true ? "true" : "false" }}" name="hidden_user[{{ $user->id }}]" >
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $belongs_to_store === true ? "Yes" : "No" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/stores/show_store.js') }}"></script>
@endsection