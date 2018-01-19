<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Role;

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
        $request->user()->authorizeRoles(['admin']);

        //$users = \App\User::all();
        //$roles = \App\Role::all();

        $user_roles = \DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('stores', 'stores.id', '=', 'users.default_store_id')
            ->select('users.name', 'users.email', 'roles.name AS role_name', 'users.default_store_id', 'stores.name AS store_name', 'users.active_flg')
            ->get();

        $allowed_user_emails = \DB::table('allowed_user_emails')
            ->join('stores', 'stores.id', '=', 'allowed_user_emails.default_store_id')
            ->join('roles', 'roles.id', '=', 'allowed_user_emails.role_id')
            ->select('allowed_user_emails.email', 'stores.name AS store_name', 'stores.id AS store_id', 'roles.id AS role_id', 'roles.name AS role_name')
            ->whereRaw('email NOT IN (SELECT email FROM users)')
            ->get();

        $stores = \App\Store::all();
        $roles = \App\Role::all();

        return view('/users/users')->with('user_roles', $user_roles)->with('allowed_user_emails', $allowed_user_emails)->with('stores', $stores)->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin']);
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
        $request->user()->authorizeRoles(['admin']);
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
    }

    /**
     * submit form to add new registerable user
     * @param Request $request
     */
    public function addRegistrableUser(Request $request) {
        $request->user()->authorizeRoles(['admin']);

        \DB::table('allowed_user_emails')->insert(
            ['email' => $request->registrant_email, 'role_id' => $request->registrant_role, 'default_store_id' => $request->registrant_default_store]
        );

        return redirect()->action('UserController@index');
    }
}
