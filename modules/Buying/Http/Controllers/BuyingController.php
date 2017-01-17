<?php namespace Modules\Buying\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Buying\Entities\BuyingOrder;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BuyingController extends Controller {
	
    public function storeOrders(Request $request)
    {
            $order = new BuyingOrder();
            $order->style = $request->style;

            if($request->sketch != ""){
                $file_extension = $request->file('sketch')->guessExtension();
                $img_name = time().".".$file_extension;
                $image = Input::file('sketch');
                $image->move('uploaded_files/buying/orders/', $img_name);
            }else{
                $img_name = "no_image.jpg";
            }

            DB::table('buying_orders')->insert([
                'id' => time(),
                'merchandiser_id' => $request->user_id,
                'style' => $request->style,
                'ref' => $request->ref,
                'pi_date' => $request->pi_date,
                'handover_date' => $request->handover_date,
                'Gauge' => $request->Gauge,
                'yarn_ref_details' => $request->yarn_ref_details,
                'qty' => $request->qty,
                'customer' => $request->customer,
                'main_label' => $request->main_label,
                'contract_weight' => $request->contract_weight,
                'sizing' => $request->sizing,
                'hang_tag' => $request->hang_tag,
                'colors' => implode('<br>', $request->colors),
                'sketch' => $img_name,
            ]);
    }

    public function fetchOrdersList($user_id, $emp_role)
    {
        if($emp_role == 1)
        {
            $data['orders'] = DB::table('buying_orders')->leftJoin('buyers', 'buying_orders.customer', '=', 'buyers.id')->select('buying_orders.*', 'buyers.buyer_name')->get();
        }
        else
        {
            $data['orders'] = DB::table('buying_orders')->leftJoin('buyers', 'buying_orders.customer', '=', 'buyers.id')->where('merchandiser_id', $user_id)->select('buying_orders.*', 'buyers.buyer_name')->get();
        }

        return $data;
    }
    
    public function updateField($user_id, $field, $id, $value)
    {
        DB::table('buying_orders')->where('id', $id)->update([
            $field => $value
        ]);

    }

    public function fetchOrderDetails($id)
    {
        $data['orders'] = DB::table('buying_orders')->leftJoin('buyers', 'buying_orders.customer', '=', 'buyers.id')->where('buying_orders.id', $id)->select('buying_orders.*', 'buyers.buyer_name')->get();
        
        return $data;
    }

    public function fetchOrderDetails($id){
        $data['order'] = DB::table('buying_orders')->where('id', $id)->get();
        return $data['order'];
    }




}