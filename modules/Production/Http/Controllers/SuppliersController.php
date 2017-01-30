<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Input;
use Modules\Production\Entities\Activity;
use Illuminate\Support\Facades\DB;
use Modules\Production\Entities\Supplier;
use Pingpong\Modules\Routing\Controller;

class SuppliersController extends Controller {

    public function index()
    {
        return view('production::suppliers.index');
    }

    public function fetchSuppliersList()
    {
        return Supplier::all();
    }

    public function show($id){
        $data['supplier_id'] = $id;
        return view('production::suppliers.show', $data);
    }

    public function fetchSupplierDetails($id){
        $data['supplier'] =  DB::table('suppliers')->leftJoin('users', 'users.id', '=', 'suppliers.merchandiser_id')->where('suppliers.id', $id)->select('suppliers.*', 'users.first_name as merchandiser_first_name', 'users.last_name as merchandiser_last_name')->get();
        return $data['supplier'];
    }

    public function deleteSupplier(Request $requestd){

        if($request->action == 'all')
        {
            Supplier::destroy($request->id);
        }
        elseif($request->action == 'single_delete')
        {
            Supplier::find($request->id)->delete();
        }
        else if($request->action == 'selected')
        {
            Supplier::destroy($request->id);
        }

        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->reference_table = 'suppliers';
        $activity->reference = serialize($request->id);
        $activity->description = 'Some suppliers have been removed from the system.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }

    public function updateField($user_id, $field, $id, $value)
    {
        Supplier::where('id', $id)->update([
            $field => $value
        ]);

        $activity = new Activity();
        $activity->user_id = $user_id;
        $activity->reference_table = 'suppliers';
        $activity->reference = serialize($id);
        $activity->description = 'A supplier details has been modified.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }

    public function store(Request $request){

        $supplier_id = time();
        $supplier = new Supplier();
        $supplier->id = $supplier_id;
        $supplier->supplier_name = $request->supplier_name;
        if($request->postal_address != ""){$supplier->postal_address = $request->postal_address;}
        if($request->merchandiser_id != ""){$supplier->merchandiser_id = $request->merchandiser_id;}
        if($request->contact_person != ""){$supplier->contact_person = $request->contact_person;}
        if($request->contact_number != ""){$supplier->contact_number = $request->contact_number;}
        if($request->email_address != ""){$supplier->email_address = $request->email_address;}
        if($request->website != ""){$supplier->website = $request->website;}
        $supplier->user_id = $request->user_id;
        if($request->file != ""){
            $file_extension = $request->file('file')->guessExtension();
            $img_name = $supplier_id.".".$file_extension;
            $image = Input::file('file');
            $image->move('uploaded_files/production/suppliers/', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $supplier->image = $img_name;
        $supplier->save();

        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->reference_table = 'suppliers';
        $activity->reference = serialize($supplier_id);
        $activity->description = 'A supplier has been created.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }

    public function uploadImage(Request $request)
    {
        return $request->all();
    }

}