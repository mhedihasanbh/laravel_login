<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('color.manage',['Colors'=>Color::all()]);
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
        $color=new Color();
        $color->name                     =$request->name;
        $color->code                     =$request->code;
        $color->descraption              =$request->descraption;
        $color->status                   =$request->status;
        $color-> save();
        return redirect()->back()->with('message','Color Infor Create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateStatus($id){
        $color=Color::find($id);
        if($color->status==1){
            $color->status=0;
            $message='Unit Status info Unpublish Successfully';
        }
        else{
            $color->status=1;
            $message='Color Status info publish Successfully';
        }
        $color->save();
        return redirect()->back()->with('message',$message);

    }

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
        return view('color.edit',[
            'Colors'=>Color::all(),
            'color'=>Color::find($id)
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
      $color=Color::find($id);
        $color->name                     =$request->name;
        $color->code                     =$request->code;
        $color->descraption              =$request->descraption;
        $color->status                   =$request->status;
        $color-> save();
        return redirect()->back()->with('message','Color Infor Create Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color=Color::find($id);
        $color->delete();
        return redirect('/color')->with('message','color delete successfully');
    }
}
