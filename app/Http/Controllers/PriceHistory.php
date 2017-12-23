<?php

namespace App\Http\Controllers;

use App\price_history;
use Illuminate\Http\Request;

class PriceHistory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price_history = new price_history;
        $price_history->price_1 = $request->price_1;
        $price_history->price_2 = $request->price_2;
        $price_history->log_date = date("Y-m-d", strtotime($request->date));

        $price_history->save();
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
}
