<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Models\Access;
use Illuminate\Http\Request;
use App\Imports\EmployedImport;
use App\Http\Requests\addEmployed;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UpdateEmployed;
use App\Http\Requests\EmployedImportRequest;
use Barryvdh\DomPDF\Facade as PDF;

class EmployedController extends Controller
{
    public function store(addEmployed $request)
    {
    	try {
    		$data = $request->all();
            
            $code = substr($data['name'], 0, 1) . substr($data['last_name'], 0, 1) . time();
	        $user = new User();
	        $user->name = $data['name'];
	        $user->middle_name = $data['middle_name'];
	        $user->last_name = $data['last_name'];
	        $user->email = $data['email'];
	        $user->code = $code;
	        $user->department_id = $data['departments'];
	        $user->access_room_911 = ($data['access_room_911'] == 'yes') ? true : false;
	        $user->save();

	        $user->roles()->attach(Role::whereName('employee')->first());

            return response()->json(['state' => 'success', 'resp' => 'Successful Registration'], 200);

    	} catch (Exception $e) {
            return response()->json(['state' => 'error', 'resp' => 'Unexpected error try again'], 500);
    	}
    }

    public function update(UpdateEmployed $request)
    {
        try {
            $data = $request->all();
            $user = User::find($data['id']);
            $user->name = $data['name_update'];
            $user->middle_name = $data['middle_name_update'];
            $user->last_name = $data['last_name_update'];
            $user->department_id = $data['departments_update'];
            $user->access_room_911 = ($data['access_room_911_update'] == 'yes') ? true : false;
            $user->save();
            return response()->json(['state' => 'success', 'resp' => 'Successful Update'], 200);
        } catch (Exception $e) {
            return response()->json(['state' => 'error', 'resp' => 'Unexpected error try again'], 500);
        }
    }

    public function changeAccess($id)
    {
        try {
            $user = User::find($id);
            $access = ($user->access_room_911) ? false :  true;
            $user->access_room_911 = $access;
            $user->save();
            return redirect('/room-911')->with('success','Updated Access');
        } catch (Exception $e) {
            return back()->with('error','Unexpected error try again');     
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return redirect('/room-911')->with('success','Successful Delete');
        } catch (Exception $e) {
            return back()->with('error','Unexpected error try again');        
        }
    }

    public function history(Request $request, $id)
    {
        $start = '';
        $end = '';
        $user = User::find($id);
        $histories = Access::whereUserId($id);

        if (isset($request->initial_date)) {
            $start = $request->initial_date;
            $end = $request->end_date;
            $dateStart = $request->initial_date . ' 00:00:00';
            $dateEnd = $request->end_date . ' 23:59:59';

            $histories = $histories->whereBetween('created_at', [$dateStart, $dateEnd]);
        }
        $histories = $histories->get();

        return view('history', compact(['histories' , 'user', 'start', 'end']));
    }

    
    public function import(EmployedImportRequest $request)
    {
        $data = $request->all();
        Excel::import(new EmployedImport($data['department']),request()->file('file'));
        return back()->with('success', 'Successful import!');
    }

    public function export(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        $histories = Access::whereUserId($data['id']);

        if (isset($data['initial_date'])) {
            $dateStart = $data['initial_date'] . ' 00:00:00';
            $dateEnd =  $data['end_date'] . ' 23:59:59';

            $histories = $histories->whereBetween('created_at', [$dateStart, $dateEnd]);
        }
        $histories = $histories->get();

        $pdf = PDF::loadView('pdf.history', compact(['histories', 'user']))->setOptions(['defaultFont' => 'sans-serif']); ;
        $name = "History-of-".$user->name."-".$user->last_name.'.pdf';
        return $pdf->download($name);
    }
}
