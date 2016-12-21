<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Buyer;
use Pingpong\Modules\Routing\Controller;

class BuyersController extends Controller {

    public function index()
    {
        return view('production::buyers.index');
    }

    public function fetchBuyersList()
    {
        return Buyer::all();
    }

    public function show($id){
        $data['buyer_id'] = $id;
        return view('production::buyers.show', $data);
    }

    public function fetchBuyerDetails($id){
        $data['buyer'] =  Buyer::where('id', $id)->get();
        $data['buyer']['user_name'] = $data['buyer'][0]->user;
        return $data['buyer'];
    }

    public function deleteBuyer(Request $request){

        if($request->action == 'all')
        {
            Buyer::truncate();
        }
        elseif($request->action == 'single_delete')
        {
            Buyer::find($request->id)->delete();
        }
        else if($request->action == 'selected')
        {
            Buyer::destroy($request->id);
        }
    }

    public function updateField($field, $id, $value)
    {
        Buyer::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $buyer_id = Buyer::max('id')+1;
        $buyer = new Buyer();
        $buyer->buyer_name = $request->buyer_name;
        $buyer->postal_address = $request->postal_address;
        $buyer->contact_person = $request->contact_person;
        $buyer->contact_number = $request->contact_number;
        $buyer->email_address = $request->email_address;
        $buyer->website = $request->website;
        $buyer->user_id = $request->user_id;
        if($request->buyer_image != ""){
            $file_extension = $request->file('buyer_image')->guessExtension();
            $img_name = $buyer_id.".".$file_extension;
            $request->file('buyer_image')->move('img/uploads/production/buyers', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $buyer->image = $img_name;
        $buyer->save();
    }
	
}