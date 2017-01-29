<?php namespace Modules\Hrm\Http\Controllers;

use App\User;
use Modules\Hrm\Entities\Employee;
use Modules\Production\Entities\Activity;
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
        return DB::table('users')->join('employees', 'users.id', '=', 'employees.id')->whereNull('employees.deleted_at')->select('users.*', 'employees.photo')->get();
    }

    public function changeFlag($flag, $user_id, $logged_user_id)
    {
    	$user = User::find($user_id);
    	$user->flag = $flag;
    	$user->save();

        if($flag == 1)
        {
            $status = "activated";
        }
        else
        {
            $status = "deactivated";
        }
        $activity = new Activity();
        $activity->user_id = $logged_user_id;
        $activity->reference_table = 'employees';
        $activity->reference = serialize($user_id);
        $activity->description = "An employee has been $status";
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }
    
    public function uploadFiles(Request $request)
    {
        if($request->file != ""){
            $file_extension = $request->file('file')->guessExtension();
            $img_name = time().".".$file_extension;
            $image = Input::file('file');
            $image->move('uploaded_files/hrm/employees/', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        DB::table($request->table_name)->where('id', $request->id)->update([
            $request->field => $img_name
        ]);
    }

    public function deleteEmployee(Request $request){

        if($request->action == 'all')
        {
            Employee::destroy($request->id);
        }
        elseif($request->action == 'single_delete')
        {
            Employee::find($request->id)->delete();
        }
        else if($request->action == 'selected')
        {
            Employee::destroy($request->id);
        }


        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->reference_table = 'employees';
        $activity->reference = serialize($request->id);
        $activity->description = 'Some employees have been removed from the system.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();

    }
    public function updateEmployeeDetails($field, $id, $value, $table_name, $login_user)
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

        $activity = new Activity();
        $activity->user_id = $login_user;
        $activity->reference_table = 'employees';
        $activity->reference = $id;
        $activity->description = 'An employee information has been updated.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }
    public function changePass(Request $request)
    {
        DB::table('users')->where('id', $request->user_id)->update([
            'password' => Hash::make($request->password)
        ]);

        $activity = new Activity();
        $activity->user_id = $request->logged_user_id;
        $activity->reference_table = 'employees';
        $activity->reference = $request->user_id;
        $activity->description = 'An employee password has been updated.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
        
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

        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->reference_table = 'employees';
        $activity->reference = $user_id;
        $activity->description = 'An employee has been removed from the system.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();

	}
}
