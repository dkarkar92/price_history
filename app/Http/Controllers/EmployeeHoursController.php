<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Role;

class EmployeeHoursController extends Controller
{

    /**
     * EmployeeHoursController constructor.
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
        $date_ranges = getCalendarDates();

        $store_ids = array();
        $stores_to_user = \Auth::user()->stores()->get();

        foreach ($stores_to_user as $key => $value) {
            $store_ids[$value->id] = $value->id;
        }

        $employees = \App\Employee::whereIn("store_id", $store_ids)->get();

        $employee_id_array = array();
        foreach ($employees as $key => $value) {
            $employee_id_array[] = $value->id;
        }

        $hours_this_week = \DB::table('employee_hours')
                                ->select('employee_id', 'amount_paid')
                                    ->whereIn("employee_id", $employee_id_array)
                                    ->where('week_start_date', $date_ranges['This Week']['start'] )
                                    ->get()->toArray();

        $hours_keyed = array();
        foreach ($hours_this_week as $key => $value) {
            $hours_keyed[$value->employee_id] = $value;
        }

        return view('/employee_hours/employee_hours')
            ->with('employees', $employees)
            ->with('stores_to_user', $stores_to_user)
            ->with('hours_this_week', $hours_keyed);

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

        //check if record exists
        $week_start_date = date("Y-m-d", strtotime($request->week_start_input));
        $now = date("Y-m-d H:i:s");

        foreach ($request->amount_paid as $employee_id => $amount) {
            $employee_cnt = \DB::table('employee_hours')->select('employee_id')->where("employee_id", $employee_id)->where('week_start_date', $week_start_date )->first();

            if (is_null($employee_cnt)) {
                \DB::table('employee_hours')->insert(
                    [   'employee_id' => $employee_id,
                        'amount_paid' => $amount,
                        "week_start_date" => $week_start_date,
                        "created_at" => $now,
                        "updated_at" => $now
                    ]
                );
            } else {
                \DB::table('employee_hours')
                    ->where('employee_id', $employee_id)
                    ->where("week_start_date", $week_start_date)
                    ->update(   [
                                    'amount_paid' => $amount,
                                    "updated_at" => $now
                                ]
                );
            }
        }

        return redirect()->action('EmployeeHoursController@index');
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
