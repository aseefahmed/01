<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Requisition;
use Pingpong\Modules\Routing\Controller;

class RequisitionsController extends Controller {

    public function index($id)
    {
        return view('production::requisitions.index');
    }

	
}