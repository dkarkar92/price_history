<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * UserController constructor.
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

        //$users = \App\User::all();
        //$roles = \App\Role::all();

        $roles = \DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('stores', 'stores.id', '=', 'users.default_store_id')
            ->select('users.name', 'users.email', 'roles.name AS role_name', 'users.default_store_id', 'stores.name AS store_name', 'users.active_flg')
            ->get();

        $allowed_user_emails = \DB::table('allowed_user_emails')
            ->join('stores', 'stores.id', '=', 'allowed_user_emails.default_store_id')
            ->select('allowed_user_emails.email', 'stores.name AS store_name', 'stores.id AS store_id')
            ->whereRaw('email NOT IN (SELECT email FROM users)')
            ->get();

        \Debugbar::info($allowed_user_emails);

        return view('/users/users')->with('roles', $roles)->with('allowed_user_emails', $allowed_user_emails);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
