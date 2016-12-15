<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Modules\Production\Entities\Order;
use Modules\Production\Entities\RequisitionItem;
use Modules\Production\Entities\RequisitionType;
use Pingpong\Modules\Routing\Controller;

class OrdersController extends Controller {

    public function index()
    {
        return view('production::orders.index');
    }

    public function fetchOrdersList()
    {
        $orders = DB::table('orders')->join('buyers', 'orders.buyer_id', '=', 'buyers.id')->join('styles', 'orders.style_id', '=', 'styles.id')->select('orders.*', 'buyers.buyer_name', 'styles.image as style_image')->get();
        return $orders;
    }

    public function show($id){
        $data['order_id'] = $id;
        return view('production::orders.show', $data);
    }

    public function fetchOrderDetails($id){
        $data['order'] =  Order::where('id', $id)->get();
        $data['order']['user'] = $data['order'][0]->user;
        $data['order']['buyer'] = $data['order'][0]->buyer;
        $data['order']['style'] = $data['order'][0]->style;
        $data['order']['composition'] = unserialize($data['order'][0]->compositions);
        return $data['order'];
    }

    public function destroy(Request $request, $id, $action=null){

        if($action == 'all')
        {
            Order::truncate();
        }
        elseif($action == 'single_delete')
        {
            Order::find($id)->delete();
        }
        else if($action == 'selected')
        {
            $items = explode(',', $id);
            Order::destroy($items);
        }

    }

    public function updateField($field, $id, $value)
    {
        Order::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $order_id = Order::max('id')+1;
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->buyer_id = $request->buyer_id;
        $order->style_id = $request->style_id;
        $order->order_date = $request->order_date;
        $order->delivery_date = $request->delivery_date;
        $order->gg = $request->order_gg;
        $order->qty = $request->order_qty;
        $order->fob = $request->order_fob;
        $order->weight_per_dzn = $request->weight_per_dzn;
        $order->total_yarn_weight = $request->total_yarn_weight;
        $order->qty_per_dzn = $request->qty_per_dzn;
        $order->total_yarn_weight = $request->total_yarn_weight;
        $order->total_yarn_cost = $request->total_yarn_cost;
        $order->acc_rate  = $request->accessories_rate;
        $order->total_acc_cost  = $request->total_accessories_cost ;
        $order->btn_cost  = $request->button_rate;
        $order->total_btn_cost  = $request->total_button_cost;
        $order->zipper_cost  = $request->zipper_rate;
        $order->total_zipper_cost  = $request->total_zipper_cost;
        $order->print_cost = $request->print_rate;
        $order->total_print_cost = $request->total_print_cost;
        $order->total_fob = $request->total_fob;
        $order->total_cost = $request->total_cost;
        $order->balance_amount = $request->order_balance_amount;
        $order->cost_of_making = $request->cost_of_making;
        $order->compositions = serialize($request->compositions);
        $order->save();
    }

    public function addToRequisition(Request $request){

        if($request->yarn_amount != '') {
            DB::table('requisition_items')->insert([
                'item_name' => 'Composition: ' . $request->yarn_type . ', Amount:' . $request->yarn_type,
                'items_val' => $request->yarn_amount,
                'requisition_type' => 'Order',
                'user_id' => Auth::user()->id,
                'reference' => $request->order_id,
            ]);
        }
        if($request->accessories_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Accessories',
                'items_val' => $request->accessories_amount,
                'requisition_type' => 'Order',
                'user_id' => Auth::user()->id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->button_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Button',
                'items_val' => $request->button_amount,
                'requisition_type' => 'Order',
                'user_id' => Auth::user()->id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->print_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Print',
                'items_val' => $request->print_amount,
                'requisition_type' => 'Order',
                'user_id' => Auth::user()->id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->zipper_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Zipper',
                'items_val' => $request->zipper_amount,
                'requisition_type' => 'Order',
                'user_id' => Auth::user()->id,
                'reference' => $request->order_id,
            ]);
        }

        $data['count'] = RequisitionItem::where('user_id', Auth::user()->id)->count();
        return $data;
    }

}