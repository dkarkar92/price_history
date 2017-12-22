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
        \Debugbar::info($request->all());
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
