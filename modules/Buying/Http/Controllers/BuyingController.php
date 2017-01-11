<?php namespace Modules\Buying\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class BuyingController extends Controller {
	
	public function index()
	{
		return view('buying::index');
	}
	
}