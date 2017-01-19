<?php namespace Modules\Hrm\Http\Controllers;

use App\User;
use Modules\Hrm\Entities\Employee;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller {

    public function fetchEmployeesList()
    {
        return DB::table('users')->join('employees', 'users.id', '=', 'employees.id')->select('users.*', 'employees.photo')->get();
    }

    public function changeFlag($flag, $user_id)
    {
    	$user = User::find($user_id);
    	$user->flag = $flag;
    	$user->save();
    }

    public function updateEmployeeDetails($field, $id, $value, $table_name)
    {
        if($table_name)
        {
            $table_name = $table_name;
        }
        else
        {
            $table_name = 'users';
        }
        DB::table($table_name)->where('id', $id)->update([
            $field => $value
        ]);
    }
    public function changePass(Request $request)
    {
        DB::table('users')->where('id', $request->user_id)->update([
            'password' => Hash::make($request->password)
        ]);
        
    }
    public function fetchEmployeeDetails($id)
    {
        $data['users'] = DB::table('users')->leftJoin('employees', 'users.id', '=', 'employees.id')->where('users.id', $id)->select('users.*', 'employees.*')->get();
        return $data;
    }
	
	public function store(Request $request)
	{
		$user_id = time();
        $user = new User();
        $user->id = $user_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);  
        $user->emp_role = $request->emp_role;   
        $user->flag = 1;   
        $user->save();

        if($request->emp_role != 10)  // If employee is not a visitor, then make entry in employee table
        {
            $employee = new Employee();
            $employee->id = $user_id;
            $employee->photo = "no_image.jpg";
            $employee->save();
        }

	}
}
