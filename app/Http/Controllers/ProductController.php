<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\productColor;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Subimage;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index(){
     $categorys      =    Category::where('catStatus', 1)->get();
     $subCategory    =    SubCategory::where('status',1)->get();
     $brands         =    Brand::where('status',1)->get();
     $units          =    Unit::where('status',1)->get();
     $colors         =    Color::where('status',1)->get();
     $sizes          =    Size::where('status',1)->get();

       return view('products.add',[
         'categories'=>$categorys,
           'subcategiries'=>$subCategory,
           'brands'=>$brands,
           'units'=>$units,
           'colors'=>$colors,
           'sizes'=> $sizes
       ]);
   }
   public function getSubcategoryByCategory(){
       $categoryId=$_GET['id'];
      $subCategory= SubCategory::where('category_id',$categoryId)->get();
      return json_encode($subCategory);
   }
   public function create(Request $request){
        $image=$request->file('main_image');
        $directory='product-images/';
       $product=new Product();
       $product->category_id            =$request->category_id;
       $product->sub_category_id        =$request->sub_category_id;
       $product->brand_id               =$request->brand_id;
       $product->unit_id                =$request->unit_id;
       $product->name                   =$request->name;
       $product->code                   =$request->code;
       $product->short_description      =$request->short_description;
       $product->long_description       =$request->long_description;;
       $product->main_price             =$request->main_price;
       $product->discount_price         =$request->discount_price;
       $product->image                  =imageUpload($image,$directory);
       $product->status                 =$request->status;
       $product->save();

       foreach($request->color as $v_color){
         $color= new  productColor();
         $color->product_id=$product->id;
         $color->color_id =  $v_color;
         $color->save();
       }
       foreach($request->size as $v_size){
          $size= new ProductSize();
           $size->product_id=$product->id;
           $size->size_id =  $v_size;
           $size->save();
       }
     $sub_images=$request->file('sub_image');
       foreach ($sub_images as $sub_image ){
           $directory='product-sub-image/';
           $subimage=new Subimage();
           $subimage->product_id= $product->id;
           $subimage->image=imageUpload($sub_image,$directory);
           $subimage->save();
       }
       return redirect('/add-product')->with('message','new product create Successfully');

   }
   public function manage(){
       $products= Product::orderBy('id','desc')->get(['id','category_id','name','main_price','discount_price','image','status']);
       return view('products.manage',['products'=> $products]);
}
public function updateStatus($id){
    $product=Product::find($id);
    if($product->status==1){
        $product->status=0;
        $message='Product Status info Unpublish Successfully';
    }
    else{
        $product->status=1;
        $message='Product Status info publish Successfully';
    }
    $product->save();
    return redirect()->back()->with('message',$message);
}
public function viewdetails($id){


       $product      = Product::find($id);
       $Productcolors       =productColor::where('product_id',$id)->get();
       $productsizes       =ProductSize::where('product_id',$id)->get();
       $subImages    =Subimage::where('product_id',$id)->get();

       return view('products.details',[
              'product'=>$product,
              'productcolors'=>$Productcolors ,
              'productsizes'=>$productsizes,
               'subImages'=>$subImages
       ]);
}
    public function productEdit($id){
        $categorys      =    Category::where('catStatus', 1)->get();
        $subCategory    =    SubCategory::where('status',1)->get();
        $brands         =    Brand::where('status',1)->get();
        $units          =    Unit::where('status',1)->get();
        $colors         =    Color::where('status',1)->get();
        $sizes          =    Size::where('status',1)->get();
        $product      = Product::find($id);
        $Productcolors       =productColor::where('product_id',$id)->get();
        $productsizes       =ProductSize::where('product_id',$id)->get();
        $subImages    =Subimage::where('product_id',$id)->get();
        return view('products.edit',[
            'product'=>$product,
            'productcolors'=>$Productcolors ,
            'productsizes'=>$productsizes,
            'subImages'=>$subImages,
            'categories'=>$categorys,
            'subcategiries'=>$subCategory,
            'brands'=>$brands,
            'units'=>$units,
            'colors'=>$colors,
            'sizes'=> $sizes
        ]);
    }
    public function productUpdate(Request $request){
         $product=Product::find($request->id);
        $image=$request->file('main_image');
         if($image){
             if(file_exists($product->image)){
                 unlink($product->image);
             }
             $directory='product-images/';
            $imageurl= imageUpload($image,$directory);
         }
      else{
          $imageurl=$product->image;
      }


        $product->category_id            =$request->category_id;
        $product->sub_category_id        =$request->sub_category_id;
        $product->brand_id               =$request->brand_id;
        $product->unit_id                =$request->unit_id;
        $product->name                   =$request->name;
        $product->code                   =$request->code;
        $product->short_description      =$request->short_description;
        $product->long_description       =$request->long_description;;
        $product->main_price             =$request->main_price;
        $product->discount_price         =$request->discount_price;
        $product->image                  =$imageurl;
        $product->status                 =$request->status;
        $product->save();
      $Productcolors       =productColor::where('product_id',$product->id)->get();
      foreach ($Productcolors as $Productcolor){
          $Productcolor->delete();
      }

        foreach($request->color as $v_color){
            $color= new  productColor();
            $color->product_id=$product->id;
            $color->color_id =  $v_color;
            $color->save();
        }
         $productsizes       =ProductSize::where('product_id',$product->id)->get();
        foreach ( $productsizes as $productsize){
            $productsize->delete();
        }
        foreach($request->size as $v_size){
            $size= new ProductSize();
            $size->product_id=$product->id;
            $size->size_id =  $v_size;
            $size->save();
        }
        $sub_images=$request->file('sub_image');
        if($sub_images){
            $subImages    =Subimage::where('product_id',$product->id)->get();
            foreach ($subImages as $subImage){
                if(file_exists($subImage->image)){
                    unlink($subImage->image);
                }
                $subImage->delete();
            }
            foreach ($sub_images as $sub_image ){
                $directory='product-sub-image/';
                $subimage=new Subimage();
                $subimage->product_id= $product->id;
                $subimage->image=imageUpload($sub_image,$directory);
                $subimage->save();
            }
            return redirect('/manage-product')->with('message',' product Update Successfully');

        }

    }
    public function productDelete($id){
         $products=Product::find($id);
         $productColors= productColor::where('product_id',$id)->get();
         foreach ( $productColors as $productColor){
             $productColor->delete();
         }
        $productSizes= ProductSize::where('product_id',$id)->get();
        foreach ( $productSizes as $productSize){
            $productSize->delete();
        }
        $productSubImages=Subimage::where('product_id',$id)->get();
        foreach ( $productSubImages as $productSubImage){
           if(file_exists($productSubImage->image)){
                   unlink($productSubImage->image);
           }
            $productSubImage->delete();
        }
        if(file_exists($products->image)){
            unlink($products->image);
        }
        $products->delete();
        return redirect('/manage-product')->with('message',' product Delete Successfully');

    }
}
