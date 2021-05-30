<?php

namespace App\Http\Controllers;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('size.manage',['sizes'=>Size::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size=new Size();
        $size->name          = $request->name;
        $size->code          = $request->code ;
        $size->descraption   = $request->descraption;
        $size->status        = $request->status;
        $size->save();
        return redirect()->back()->with('message','Size infor create successfully');
    }

     public function updateStatus($id){
         $size=Size::find($id);
         if($size->status==1){
             $size->status=0;
             $message='Size Status info Unpublish Successfully';
         }
         else{
             $size->status=1;
             $message='Size Status info publish Successfully';
         }
         $size->save();
         return redirect()->back()->with('message',$message);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('size.edit',[
            'sizes'=>Size::all(),
            'size'=>Size::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $size=Size::find($id);
        $size->name          = $request->name;
        $size->code          = $request->code ;
        $size->descraption   = $request->descraption;
        $size->status        = $request->status;
        $size->save();
        return redirect('/size')->with('message','Size infor create successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size=Size::find($id);
        $size->delete();
        return redirect('/size')->with('message','size info delete successfully');
    }
}
