<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
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

    public function destroyAllRequistion(Request $request, $id, $action=null){
        if($action == 'all')
        {
            Requisition::where('created_by', Auth::user()->id)->delete();
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

    public function viewRequisitionsList($action)
    {
        return view('production::requisitions.'.$action);
    }

    public function getRequisitionsList($action)
    {
        if($action == 'sent')
        {
            $data['requisition'] = Requisition::join('users', 'users.id', '=', 'requisitions.created_by')->where('created_by', Auth::user()->id)->where('flag',1)->select('requisitions.*', 'users.first_name', 'users.last_name')->get();
        }
        elseif ($action == 'recieved')
        {
            $data['requisition'] = Requisition::join('users', 'users.id', '=', 'requisitions.created_by')->where('forwarded_to', Auth::user()->id)->where('flag',1)->select('requisitions.*', 'users.first_name', 'users.last_name')->get();
        }
        return $data;
    }

    public function loadRequisitionDetails($id)
    {
        $data['requisition_id'] = $id;
        return view('production::requisitions.details', $data);
    }

    public function getRequisitionDetails($id)
    {
        $data['requisition'] = DB::table('requisitions')->leftJoin('requisition_items','requisitions.id', '=', 'requisition_items.requisition_id')->where('requisitions.id', $id)->select('requisitions.*', 'requisition_items.items_val', 'requisition_items.item_name', 'requisition_items.flag as item_flag', 'requisition_items.id as requisition_item_id')->get();
        return $data;
    }

    public function approveRequisition(Request $request)
    {
        if($request->flag == 9)
        {
            RequisitionItem::where('requisition_id', $request->requisition_id)->update(['flag' => 9]);
            Requisition::where('id', $request->requisition_id)->update(['approved_amount' => $request->amount, 'flag' => $request->flag]);
        }
        elseif($request->flag == 2)
        {
            Requisition::where('id', $request->requisition_id)->update(['approved_amount' => $request->amount, 'flag' => $request->flag]);
        }

    }


}