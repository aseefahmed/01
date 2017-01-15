<?php namespace Modules\Buying\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Buying\Entities\BuyingOrder;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyingController extends Controller {
	
	public function storeOrders(Request $request)
	{
		$order = new BuyingOrder();
		$order->style = $request->style;
		
		DB::table('buying_orders')->insert([
				'id' => time(),
                'style' => $request->style,
                'ref' => $request->ref,
                'pi_date' => $request->pi_date,
                'handover_date' => $request->handover_date,
                'Gauge' => $request->Gauge,
                'yarn_ref_details' => $request->yarn_ref_details,
                'qty' => $request->qty,
                'main_label' => $request->main_label,
            ]);
	}



}