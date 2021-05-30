<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public $units;
    public function __construct()
    {
        $this->units=Unit::all();
    }

    public function index(){
        return view('unit.manage',['units'=>$this->units]);
    }
    public function create(Request $request){

        $unit=new Unit();
        //$category->Cat-name = $request->cat_name;
        $unit->name                   =$request->name;
        $unit->code                   =$request->code;
        $unit->descraption            =$request->descraption;
        $unit->status                 =$request->status;
        $unit-> save();
        return redirect()->back()->with('message','Unit Infor Create Successfully');
    }
    public function updateStatus($id){
        $unit=Unit::find($id);
        if($unit->status==1){
            $unit->status=0;
            $message='Unit Status info Unpublish Successfully';
        }
        else{
            $unit->status=1;
            $message='Unit Status info publish Successfully';
        }
        $unit->save();
        return redirect()->back()->with('message',$message);

    }
    public function unitEdit($id){
        return view('unit.edit',[
            'units'=>$this->units,
            'unit'=>Unit::find($id)
        ]);
    }
    public function unitupdate(Request $request){
        $unit=Unit::find($request->id);
        $unit->name              =$request->name;
        $unit->code              =$request->code;
        $unit->descraption	     =$request->descraption;
        $unit->status            =$request->status;
        $unit-> save();
        return redirect('/manage-unit')->with('message','Unit Infor Update Successfully');
    }
    public function unitDelete($id){
        $unit=Unit::find($id);

        $unit->delete();
        return redirect('/manage-unit')->with('message','Unit Infor Delelte Successfully');
    }
}
