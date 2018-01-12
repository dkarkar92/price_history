<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\User;

class StoreController extends Controller
{

    /**
     * StoreController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = \App\Store::where('active_flg', true)->get();

        return view('/stores/stores')->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stores = new \App\Store;
        $stores->name = $request->name;
        $stores->address_1 = $request->address_1;
        if (!empty($request->address_1)) {
            $stores->address_2 = $request->address_2;
        }
        $stores->city = $request->city;
        $stores->state = $request->state;
        $stores->postal_code = $request->postal_code;

        $stores->active_flg = true;

        $stores->save();

        return redirect()->action('StoreController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = \App\Store::find($id);
        //$users = \App\User::all();
        $users = new \App\User();
        $users_to_store = $users->findUsersByStore($id);
        $users = \App\User::all();

        //foreach ($users as $user) {
        //\Debugbar::info($user->stores()->get());
        //}

        /*$stores = \App\User::find(1)->stores()->where('id', $id)->get();

        foreach ($stores as $single) {
            \Debugbar::info($single->name);
        }*/

        /*\Debugbar::info($users_to_store);
        echo "<pre>";
        print_r($users_to_store);
        echo "</pre>";*/

        $users_in_store = array();
        foreach ($users_to_store as $user) {
            $users_in_store[$user->email] = $user;
        }

        return view('/stores/show_store')->with('store', $store)->with('users_in_store', $users_in_store)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = \App\Store::find($id);

        return view('/stores/edit_store')->with('store', $store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = \App\Store::find($id);

        $store->name = $request->name;
        $store->address_1 = $request->address_1;
        $store->address_2 = $request->address_2;
        $store->city = $request->city;
        $store->state = $request->state;
        $store->postal_code = $request->postal_code;

        $store->save();

        return redirect()->action('StoreController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = \App\Store::find($id);

        $store->active_flg = false;

        $store->save();

        return redirect()->action('StoreController@index');
    }

    /**
     * Add a specific user to a specific store
     * @todo needs work
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $store_id
     * @return \Illuminate\Http\Response
     */
    public function addUserToStore(Request $request, $store_id)
    {
        $deactive_users = array();
        if (!empty($request->all()['hidden_user'])) {
            //find which users in 'users_to_store' that
            \Debugbar::info($request->all());
            if (empty($request->all()['users_to_store'])) {
                foreach ($request->all()['hidden_user'] as $user_id => $value) {
                    $deactive_users[] = $user_id;
                }
            } else {
                foreach ($request->all()['hidden_user'] as $user_id => $value) {
                    if (!array_key_exists($user_id, $request->all()['users_to_store'])) {
                        $deactive_users[] = $user_id;
                    }
                }
            }

            //print_r($deactive_users);
            foreach ($deactive_users as $user_id) {
                \DB::update('UPDATE users_to_stores SET active_flg = false, updated_at = ? WHERE user_id = ? AND store_id = ?', [date("Y-m-d H:i:s"), $user_id, $store_id]);
            }
        }

        //make sure to check for users deactivated
        if (!empty($request->all()['users_to_store'])) {
            foreach ($request->all()['users_to_store'] as $key => $value) {
                \DB::insert('INSERT INTO users_to_stores (user_id, store_id, active_flg, created_at) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE active_flg = ?, updated_at = ?',
                    [
                        $value, $store_id, true, date("Y-m-d H:i:s"), true, date("Y-m-d H:i:s")
                    ]
                );
            }
        }

        return redirect()->action('StoreController@show', ['id' => $store_id]);
    }
}
