<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expanse;
use APP\Store;

class ExpanseController extends Controller
{

    /**
     * ExpanseController constructor.
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
            ->where('users_to_stores.active_flg', 1)
            ->get();

        if ($stores_to_user->isNotEmpty()) {
            $default_store_exists = false;
            foreach ($stores_to_user as $key => $value) {
                if ($value->id == $default_store_id) {
                    $default_store_exists = true;
                    break;
                }
            }
        } else {
            $default_store_exists = true;
        }

        if ($default_store_exists === true) {
            $expanses = \App\expanse::orderBy("log_date", "ASC")->where('store_id', $default_store_id)->get();
        } else {
            foreach ($stores_to_user as $key => $value) {
                $store_id = $value->id;
                break;
            }
            $expanses = \App\expanse::orderBy("log_date", "ASC")->where('store_id', $store_id)->get();
        }

        return view('/expanses/expanses')
            ->with('expanses', $expanses)
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

        $expanses = new expanse;
        $expanses->amount        = $request->amount;
        $expanses->payment_type  = $request->payment_type;
        $expanses->description   = $request->description;
        $expanses->store_id      = $request->store_id;
        $expanses->log_date      = date("Y-m-d", strtotime($request->date));

        $expanses->save();

        //return redirect('/');
        return redirect()->action(
            'ExpanseController@show', ['store_id' => $request->store_id]
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
            ->where('users_to_stores.active_flg', 1)
            ->get();

        $expanses = \App\expanse::orderBy("log_date", "ASC")->where('store_id', $store_id)->get();

        return view('/expanses/expanses')
            ->with('expanses', $expanses)
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
        $request->user()->authorizeRoles(['admin']);

        $expanse = \App\Expanse::find($id);

        return view('/expanses/edit_expanse')->with('expanse', $expanse);
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

        $expanse = \App\Expanse::find($id);

        $expanse->amount = $request->amount;
        $expanse->payment_type = $request->payment_type;
        $expanse->description = $request->description;

        $expanse->save();

        return redirect()->action('ExpanseController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);

        $expanse = \App\Expanse::find($id);
        $expanse->delete();

        return redirect()->action('ExpanseController@index');


    }


        /**
         * return expanse data for a specific store on a specific day.
         * @return JSON
         */
      public function getExpanseDataForDay(Request $request) {
            $request->user()->authorizeRoles(['employee', 'manager', 'admin']);
            $date = $request->date;
            $date = date("Y-m-d", strtotime($date));

            $store_id = $request->store_id;

            $expanses = \App\expanse::where('store_id', $store_id)->where("log_date", $date)->first();

            if (empty($expanses)) {
                $expanses = array();
            }

            return json_encode($expanses);
        }
}
