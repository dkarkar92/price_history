<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Role;

class EmployeeController extends Controller
{

    /**
     * EmployeeController constructor.
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
        $request->user()->authorizeRoles(['manager', 'admin']);

        $store_ids = array();
        $stores_to_user = \Auth::user()->stores()->get();

        foreach ($stores_to_user as $key => $value) {
            $store_ids[$value->id] = $value->id;
        }

        //$employees = \App\Employee::whereIn("store_id", $store_ids)->get();
        $employees = \DB::table('employees')
                        ->join('roles', 'roles.id', '=', 'employees.role_id')
                        ->select('employees.*', 'roles.name AS role_name')
                        ->whereIn("store_id", $store_ids)
                        ->get();

        $roles = \App\Role::all();

        return view('/employees/employees')
            ->with('employees', $employees)
            ->with('stores_to_user', $stores_to_user)
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['manager', 'admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['manager', 'admin']);

        $employee = new \App\Employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->weekly_pay_rate = $request->weekly_pay_rate;
        $employee->role_id = $request->employee_role;
        $employee->store_id = $request->employee_store;

        $employee->active_flg = true;

        $employee->save();

        return redirect()->action('EmployeeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['manager', 'admin']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['manager', 'admin']);
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
        $request->user()->authorizeRoles(['manager', 'admin']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['manager', 'admin']);
    }
}
