<?php namespace Modules\Hrm\Http\Controllers;

use App\User;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Input;
use Pingpong\Modules\Routing\Controller;

class EmployeesController extends Controller {

    public function fetchEmployeesList()
    {
        return User::all();
    }
	
}
