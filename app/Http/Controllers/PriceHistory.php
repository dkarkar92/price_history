<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\price_history;

class PriceHistory extends Controller
{

    /**
     * PriceHistory constructor.
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
        $price_history = \App\price_history::orderBy("log_date", "ASC")->get();

        return view('price_history')->with('price_history', $price_history);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        die("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price_history = new price_history;
        $price_history->cash = $request->cash;
        $price_history->credit_card = $request->credit_card;
        $price_history->log_date = date("Y-m-d", strtotime($request->date));

        $price_history->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\price_history  $price_history
     * @return \Illuminate\Http\Response
     */
    public function show(price_history $price_history)
    {
        //
        die("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\price_history  $price_history
     * @return \Illuminate\Http\Response
     */
    public function edit(price_history $price_history)
    {
        //
        die("edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\price_history  $price_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, price_history $price_history)
    {
        //
        die("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\price_history  $price_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(price_history $price_history)
    {
        //
    }

    /**
     * Query and return JSON response for price_history graph data
     *
     * @return string \Illuminate\Http\Response
     */
    public function graph()
    {
        $price_history = \App\price_history::orderBy("log_date", "ASC")->get();

        $price_dataset = array();
        foreach ($price_history as $key => $value) {
            $price_dataset['date'][] = $value['log_date'];
            $price_dataset['cash'][] = $value['cash'];
            $price_dataset['credit_card'][] = $value['credit_card'];
        }

        return json_encode($price_dataset);
    }
}
