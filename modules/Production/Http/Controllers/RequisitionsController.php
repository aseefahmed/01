<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Requisition;
use Modules\Production\Entities\RequisitionItem;
use Pingpong\Modules\Routing\Controller;

class RequisitionsController extends Controller {


    public function generateRequisition()
    {
        return view('production::requisitions.generate');
    }

    public function getRequisitionItems()
    {
        $data['items'] = RequisitionItem::where('user_id', Auth::user()->id)->where('flag', 0)->get();
        return $data;
    }

    public function generateRequisitionItems(Request $request)
    {
        $requisition = new Requisition();
        $requisition->requested_amount = $request->total_amount;
        $requisition->created_by = Auth::user()->id;
        $requisition->forwarded_to = $request->forwarded_to;
        $requisition->name = $request->requisition_title;
        $requisition->flag = 1;
        $requisition->save();

        $requisition_id = Requisition::max('id');
        foreach($request->requisition_items as $item)
        {
            RequisitionItem::where('id',$item)->update(['flag' => 1, 'requisition_id' => $requisition_id]);
        }
    }

    public function destroy(Request $request, $id, $action=null){
        if($action == 'all')
        {
            RequisitionItem::where('user_id', Auth::user()->id)->delete();
        }
        elseif($action == 'single_delete')
        {
            RequisitionItem::find($id)->delete();
        }
        else if($action == 'selected')
        {
            $items = explode(',', $id);
            RequisitionItem::destroy($items);
        }
    }

    public function viewRequisitionsList()
    {
        return view('production::requisitions.sent');
    }

    public function getRequisitionsList($action)
    {
        $data['requisition'] = Requisition::where('created_by', Auth::user()->id)->where('flag',1)->get();
        return $data;
    }


}