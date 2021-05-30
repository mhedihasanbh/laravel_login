<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public $brands;
    public function __construct()
    {
        $this->brands=Brand::all();
    }

    public function index(){
        return view('brand.manage',['brands'=>$this->brands]);
    }
    public function create(Request $request){
        $imageurl='';
        if($image= $request->file('brand_image')){
            $type=$image->getClientOriginalExtension();
            $name=time().'.'.$type;
            $directory='brand-images/';
            $image->move($directory,$name);
            $imageurl=$directory.$name;
        }
        $brand=new Brand();
        //$category->Cat-name = $request->cat_name;
          $brand->brand_name            =$request->brand_name;
          $brand->brand_descraption     =$request->brand_descraption;
          $brand->brand_image            = $imageurl;
          $brand->status                 =$request->status;
          $brand-> save();
        return redirect()->back()->with('message','Brand Infor Create Successfully');
    }
    public function updateStatus($id){
        $brand=Brand::find($id);
        if($brand->status==1){
            $brand->status=0;
            $message='Brand Status info Unpublish Successfully';
        }
        else{
            $brand->status=1;
            $message='Brand Status info publish Successfully';
        }
        $brand->save();
        return redirect()->back()->with('message',$message);

    }
    public function brandEdit($id){
        return view('brand.edit',[
            'brands'=>$this->brands,
            'brand'=>Brand::find($id)
        ]);
    }
    public function Brandupdate(Request $request){
        $category=Brand::find($request->id);
        if($image= $request->file('brand_image')){
            if(file_exists($category->brand_image)) {
                unlink($category->brand_image);
            }

            $type=$image->getClientOriginalExtension();
            $name=time().'.'.$type;
            $directory='create-images/';
            $image->move($directory,$name);
            $imageurl=$directory.$name;
        }
        else{
            $imageurl= $category->catImage;
        }
        $category->CatName            =$request->cat_name;
        $category->catDescraption     =$request->cat_descraption;
        $category->catImage           = $imageurl;
        $category->	catStatus         =$request->status;
        $category-> save();
        return redirect('/manage-brand')->with('message','Brand Infor Update Successfully');
    }
    public function categoryDelete($id){
        $category=Brand::find($id);
        if(file_exists($category->catImage)) {
            unlink($category->catImage);
        }
        $category->delete();
        return redirect('/manage-brand')->with('message','Brand Infor Delelte Successfully');
    }
}
