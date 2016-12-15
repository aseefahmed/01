<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Requisition;
use Modules\Production\Entities\RequisitionItem;
use Pingpong\Modules\Routing\Controller;

class RequisitionsController extends Controller {

    public function index($id)
    {
        return view('production::requisitions.'.$id);
    }

    public function generateRequisition()
    {
        return view('production::requisitions.generate');
    }

    public function getRequisitionItems()
    {
        $data['items'] = RequisitionItem::where('user_id', Auth::user()->id)->where('flag', 0)->get();
        return $data;
    }

	
}