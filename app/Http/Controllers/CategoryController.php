<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categories;
    public function __construct()
    {
        $this->categories=Category::all();
    }

    public function index(){

        //$this->categories=Category::all();
        return view('category.manage',['categories'=>$this->categories]);
}

    public function create(Request $request){
        $imageurl='';
       if($image= $request->file('cat-image')){
              $type=$image->getClientOriginalExtension();
              $name=time().'.'.$type;
              $directory='create-images/';
              $image->move($directory,$name);
             $imageurl=$directory.$name;
       }
       $category=new Category();
        //$category->Cat-name = $request->cat_name;
        $category->CatName            =$request->cat_name;
        $category->catDescraption     =$request->cat_descraption;
        $category->catImage           = $imageurl;
        $category->	catStatus         =$request->status;
        $category-> save();
        return redirect()->back()->with('message','Category Infor Create Successfully');
    }
    public function updateStatus($id){
            $category=Category::find($id);
            if($category->catStatus==1){
                $category->catStatus=0;
                $message='Category Status info Unpublish Successfully';
            }
            else{
                $category->catStatus=1;
                $message='Category Status info publish Successfully';
            }
            $category->save();
            return redirect()->back()->with('message',$message);

   }
   public function categoryEdit($id){
       return view('category.edit',[
           'categories'=>$this->categories,
           'category'=>Category::find($id)
       ]);
   }
   public function categoryupdate(Request $request){
        $category=Category::find($request->id);
       if($image= $request->file('cat-image')){
           if(file_exists($category->catImage)) {
               unlink($category->catImage);
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
       return redirect('/manage-category')->with('message','Category Infor Create Successfully');
   }
   public function categoryDelete($id){
       $category=Category::find($id);
       if(file_exists($category->catImage)) {
           unlink($category->catImage);
       }
       $category->delete();
       return redirect('/manage-category')->with('message','Category Infor Delelte Successfully');
   }

}
