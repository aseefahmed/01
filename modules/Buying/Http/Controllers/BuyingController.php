<?php namespace Modules\Buying\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Buying\Entities\BuyingOrder;
use Modules\Buying\Entities\BuyingOrdersColor;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BuyingController extends Controller {
	
    public function storeOrders(Request $request)
    {
            $order = new BuyingOrder();
            $order->style = $request->style;
            $time = time();
            if($request->sketch != ""){
                $file_extension = $request->file('sketch')->guessExtension();
                $img_name = $time.".".$file_extension;
                $image = Input::file('sketch');
                $image->move('uploaded_files/buying/orders/', $img_name);
            }else{
                $img_name = "no_image.jpg";
            }

            $created_at = date_format(date_create(Date('Y-m-d h:i:s')), 'Y-m-d h:i:s');
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
                'main_label' => $request->main_label,
                'contract_weight' => $request->contract_weight,
                'sizing' => $request->sizing,
                'hang_tag' => $request->hang_tag,
                'sketch' => $img_name,
                'created_at' => $created_at
            ]);
    }

    public function addColor($color, $type, $order_id)
    {
        DB::table('buying_orders_colors')->insert(
            [
                'color_name' => $color, 
                'color_type' => $type,
                'order_id' => $order_id
            ]
        );
    }
    public function fetchOrdersList($user_id, $emp_role)
    {
        if($emp_role == 1)
        {
            $data['orders'] = DB::table('buying_orders')->leftJoin('buyers', 'buying_orders.customer', '=', 'buyers.id')->leftJoin('users', 'users.id', '=', 'buying_orders.merchandiser_id')->select('buying_orders.*', 'buyers.buyer_name', 'users.first_name as merchandiser_first_name', 'users.last_name as merchandiser_last_name')->get();
        }
        else
        {
            $data['orders'] = DB::table('buying_orders')->leftJoin('buyers', 'buying_orders.customer', '=', 'buyers.id')->where('merchandiser_id', $user_id)->select('buying_orders.*', 'buyers.buyer_name')->get();
        }
        $data['data_of_14_days_ago'] = date("Y-m-d", strtotime("today"));
        return $data;
    }
    
    public function updateField($user_id, $field, $id, $value, $table)
    {
        DB::table($table)->where('id', $id)->update([
            $field => $value
        ]);

    }

    public function fetchOrdersStats()
    {
        $last_day_of_month = date_format(date_create(date('d-m-Y', strtotime('last day of this month'))), 'Y-m-d');
        $first_day_of_month = date_format(date_create(date('d-m-Y', strtotime('first day of this month'))), 'Y-m-d');
        $data['no_of_orders_handedover'] = DB::table('buying_orders')->where('handedover_date', '!=', '0000-00-00')->count();
        $data['no_of_po_recieved'] = DB::table('buying_orders')->where('po', '=', 'Yes')->count();
        $data['no_of_orders_inspected'] = DB::table('buying_orders')->where('inspection_date', '!=', '0000-00-00')->count();
        $data['new_orders'] = DB::table('buying_orders')->where('created_at', '>=', $first_day_of_month)->where('created_at', '<=', $last_day_of_month)->count();
        $data['handedover_this_month'] = DB::table('buying_orders')->where('handedover_date', '>=', $first_day_of_month)->where('handedover_date', '<=', $last_day_of_month)->count();
        $data['no_of_po_recieved_this_month'] = DB::table('buying_orders')->where('po_recieved_date', '>=', $first_day_of_month)->where('po_recieved_date', '<=', $last_day_of_month)->count();
        return $data;
    }

    public function uploadFiles(Request $request)
    {
        if($request->file != ""){
            $file_extension = $request->file('file')->guessExtension();
            $img_name = time().".".$file_extension;
            $image = Input::file('file');
            $image->move('uploaded_files/buying/orders/', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        DB::table($request->table_name)->where('id', $request->id)->update([
            $request->field => $img_name
        ]);
    }
    public function fetchOrderDetails($id)
    {
        $data['orders'] = DB::table('buying_orders')->leftJoin('buyers', 'buying_orders.customer', '=', 'buyers.id')->where('buying_orders.id', $id)->select('buying_orders.*', 'buyers.buyer_name')->get();
        $data['colors'] = DB::table('buying_orders_colors')->where('order_id', $id)->get();
        return $data;
    }




}