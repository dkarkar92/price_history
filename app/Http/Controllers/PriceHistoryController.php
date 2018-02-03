<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\price_history;
use App\Store;

class PriceHistoryController extends Controller
{

    /**
     * PriceHistoryController constructor.
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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);

        $default_store_id = \Auth::user()->default_store_id;
        $store = \App\Store::where('id', $default_store_id)->first();

        $stores_to_user = \DB::table('users_to_stores')
            ->join('users', 'users.id', '=', 'users_to_stores.user_id')
            ->join('stores', 'stores.id', '=', 'users_to_stores.store_id')
            ->select('stores.id', 'stores.name')
            ->where('users.id', \Auth::user()->id)
            ->where('users.active_flg', 1)
            ->where('stores.active_flg', 1)
            ->get();

        $price_history = \App\price_history::orderBy("log_date", "ASC")->where('store_id', $default_store_id)->get();

        return view('price_history')
            ->with('price_history', $price_history)
            ->with('store', $store)
            ->with('stores_to_user', $stores_to_user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);

        $price_history = new price_history;
        $price_history->cash        = $request->cash;
        $price_history->credit_card = $request->credit_card;
        $price_history->store_id    = $request->store_id;
        $price_history->log_date    = date("Y-m-d", strtotime($request->date));

        $price_history->save();

        //return redirect('/');
        return redirect()->action(
            'PriceHistoryController@show', ['store_id' => $request->store_id]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $store_id)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);

        $store = \App\Store::where('id', $store_id)->first();

        $stores_to_user = \DB::table('users_to_stores')
            ->join('users', 'users.id', '=', 'users_to_stores.user_id')
            ->join('stores', 'stores.id', '=', 'users_to_stores.store_id')
            ->select('stores.id', 'stores.name')
            ->where('users.id', \Auth::user()->id)
            ->where('users.active_flg', 1)
            ->where('stores.active_flg', 1)
            ->get();

        $price_history = \App\price_history::orderBy("log_date", "ASC")->where('store_id', $store_id)->get();

        return view('price_history')
            ->with('price_history', $price_history)
            ->with('store', $store)
            ->with('stores_to_user', $stores_to_user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['employee', 'manager', 'admin']);
    }


        /**
         * Query and return JSON response for price_history graph data
         *
         * @return string \Illuminate\Http\Response
         */
        public function graph(Request $request)
        {
            $request->user()->authorizeRoles(['employee', 'manager', 'admin']);

            //$default_store_id = \Auth::user()->default_store_id;
            $store_id = $request->store_id;

            $price_history = \App\price_history::orderBy("log_date", "ASC")->where('store_id', $store_id)->get();

            $price_dataset = array();
            foreach ($price_history as $key => $value) {
                $price_dataset['date'][] = $value['log_date'];
                $price_dataset['cash'][] = $value['cash'];
                $price_dataset['credit_card'][] = $value['credit_card'];
            }

            return json_encode($price_dataset);
        }

        /**
         * return price history data for a specific store on a specific day.
         * @return JSON
         */
        public function getPriceDataForDay(Request $request) {
            $request->user()->authorizeRoles(['employee', 'manager', 'admin']);
            $date = $request->date;
            $date = date("Y-m-d", strtotime($date));

            $store_id = $request->store_id;

            $price_history = \App\price_history::where('store_id', $store_id)->where("log_date", $date)->first();

            if (empty($price_history)) {
                $price_history = array();
            }

            return json_encode($price_history);
        }
}
