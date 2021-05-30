<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
     return view('sub-category.manage',[
         'categories'=>Category::all(), //category nia asar jonno use korci
         'subCategories'=>SubCategory::all()
     ]);
    }
    public function create(Request $request){
       $this->validate($request,[
             'cat_name'=>'required|max:100|unique:sub_categories',
             'cat-image'=>'required|image'
           ]);

        $imageurl='';
        if($image= $request->file('cat-image')){
            $type=$image->getClientOriginalExtension();
            $name=time().'.'.$type;
            $directory='sub-category-images/';
            $image->move($directory,$name);
            $imageurl=$directory.$name;
        }
        $subCategory=new SubCategory();
        $subCategory->category_id= $request->category_id;
        $subCategory->cat_name= $request->cat_name;
        $subCategory->cat_descraption= $request->cat_descraption;
        $subCategory->cat_image= $imageurl;
        $subCategory->status= $request->status;
        $subCategory->save();
        return redirect()->back()->with('message','Sub-category Created Successfully');

    }
    public  function updateStatus($id){
        $subCategory=SubCategory::find($id);
        if($subCategory->status==1){
            $subCategory->status=0;
            $message='Category Status info Unpublish Successfully';
        }
        else{
            $subCategory->status=1;
            $message='Category Status info publish Successfully';
        }
        $subCategory->save();
        return redirect()->back()->with('message',$message);
    }
public function categoryEdit($id){
    return view('sub-category.edit',[
        'categories'=>Category::all(), //category nia asar jonno use korci
        'subCategories'=>SubCategory::all(),
        'subCategory'=>SubCategory::find($id)
    ]);
}
public function categoryupdate(Request $request){
    $imageurl='';
    $subCategory=SubCategory::find($request->id);
    if($image= $request->file('cat-image')){
        $type=$image->getClientOriginalExtension();
        $name=time().'.'.$type;
        $directory='sub-category-images/';
        $image->move($directory,$name);
        $imageurl=$directory.$name;
    }
    else{
        $imageurl=$subCategory->cat_image;
    }

    $subCategory->category_id          = $request->category_id;
    $subCategory->cat_name             = $request->cat_name;
    $subCategory->cat_descraption      = $request->cat_descraption;
    $subCategory->cat_image            = $imageurl;
    $subCategory->status              = $request->status;
    $subCategory->save();
    return redirect('/manage-sub-category')->with('message','Sub-category Update Successfully');

}
public function subDelete($id){
    $subcategory=SubCategory::find($id);
    if(file_exists( $subcategory->catImage)) {
        unlink( $subcategory->catImage);
    }
    $subcategory->delete();
    return redirect('/manage-sub-category')->with('message','Sub-Category Infor Delelte Successfully');
}
}
