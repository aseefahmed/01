<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Order;
use Pingpong\Modules\Routing\Controller;

class OrdersController extends Controller {

    public function index()
    {
        return view('production::orders.index');
    }

    public function fetchOrdersList()
    {
        return Order::all();
    }

    public function show($id){
        $data['order_id'] = $id;
        return view('production::orders.show', $data);
    }

    public function fetchOrderDetails($id){
        $data['order'] =  Order::where('id', $id)->get();
        $data['order']['buyer_details'] = $data['order'][0]->buyer_details;
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
        $order->buyer = $request->buyer;
        $order->save();
    }
	
}