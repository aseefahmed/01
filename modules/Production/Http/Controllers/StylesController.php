<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Style;
use Pingpong\Modules\Routing\Controller;

class StylesController extends Controller {

    public function index()
    {
        return view('production::styles.index');
    }

    public function fetchStylesList()
    {
        return Style::all();
    }

    public function show($id){
        $data['style_id'] = $id;
        return view('production::styles.show', $data);
    }

    public function fetchStyleDetails($id){
        $data['style'] =  Style::where('id', $id)->get();
        $data['style']['user_name'] = $data['style'][0]->user;
        return $data['style'];
    }

    public function destroy(Request $request, $id, $action=null){

        if($action == 'all')
        {
            Style::truncate();
        }
        elseif($action == 'single_delete')
        {
            Style::find($id)->delete();
        }
        else if($action == 'selected')
        {
            $items = explode(',', $id);
            Style::destroy($items);
        }

    }

    public function updateField($field, $id, $value)
    {
        Style::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $style_id = Style::max('id')+1;
        $style = new Style();
        $style->style_name = $request->style_name;
        $style->user_id = Auth::user()->id;
        if($request->style_image != ""){
            $file_extension = $request->file('style_image')->guessExtension();
            $img_name = $style_id.".".$file_extension;
            $request->file('style_image')->move('img/uploads/production/styles', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $style->image = $img_name;
        $style->save();
    }

}