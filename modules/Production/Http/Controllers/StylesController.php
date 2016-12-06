<?php namespace Modules\Production\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class BrandsController extends Controller {
	
	public function index()
	{
		return view('production::index');
	}
	
}