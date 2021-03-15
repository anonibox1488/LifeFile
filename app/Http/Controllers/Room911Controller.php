<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Access;
use App\User;

class Room911Controller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $depart = $request->search_departments;

        $total = 0;
        $departaments = Department::all();

        $employees = User::whereNotNull('code')
        ->search($search)
        ->department($depart);
        
        if (isset($request->initial_date)) {
            $employees = $employees->whereIn('id', $this->rangeDate($request));
        }
        
        $employees = $employees->paginate(10);

        foreach ($employees as $employed) {
        	$access = Access::where(['user_id' => $employed->id, "access" => true, 'department_id' => 2])
        		->get();
        	$total = count($access);
    		if($total > 0){
    			$last = $access->last();
				$employed->last_access = $last->created_at->format('d-m-Y H:i:s');
    		}
            $employed->total = $total;
            $employed->access_button = ($employed->access_room_911) ? 'Disable': 'Enable' ;
        }

        return view('room911', compact(['departaments', 'employees']));
    }

    public function rangeDate($request)
    {
        $dateStart = $request->initial_date . ' 00:00:00';
        $dateEnd = $request->end_date . ' 23:59:59';
        
        $access = Access::select('user_id')
        ->where(["access" => true, 'department_id' => 2])
        ->whereBetween('created_at', [$dateStart, $dateEnd])
        ->get();

        $ids = [];

        foreach ($access as $key => $user) {
            array_push($ids, $user->user_id);
        }

        return $ids;
    }

    public function accessControl(Request $request)
    {
        $data = $request->all();
        
        $user = User::whereCode($data['code'])->first();
        
        $user_id = ($user) ? $user->id : 0 ;

        $permission = ($user) ? ($user->access_room_911) ? true : false : false;
        
        $access = new Access();
        $access->department_id = 2;
        $access->user_id = $user_id;
        $access->access = $permission;
        $access->code = $data['code'];
        $access->save();

        if ($permission) {
            return redirect('/home')->with('success','Access Granted');    
        }
        return redirect('/home')->with('error','Access Denied');
        
    }

}
