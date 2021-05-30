<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Subimage;
use Illuminate\Http\Request;

class APIController extends Controller
{
   public function getFeatureProducts(){
      $products=Product::orderBy('id','desc')->take(20)->get();
      $result=[];
      foreach ($products as $key=>$product){
          $result[$key]['id']=$product->id;
          $result[$key]['name']=$product->name;
          $result[$key]['image']=asset($product->image);
          //$result[$key]['image1']=asset(Subimage::where('product_id',$product->id)->first()->image);
          $result[$key]['price']=$product->discount_price;
      }
      return response()->json($result);
   }

   public function getBestlookproduct(){
       $popularProducts=Product::where('status',1)->orderBy('hit_count','desc')->take(8)->get();
       $popularRes=[];
       foreach ($popularProducts as $key=> $popularProduct){
           $popularRes[$key]['id']       =$popularProduct->id;
           $popularRes[$key]['name']     =$popularProduct->name;
           $popularRes[$key]['image']    =asset($popularProduct->image);
//           $popularRes[$key]['image1']   =asset(Subimage::where('product_id',$popularProduct->id)->first()->image);
           $popularRes[$key]['price']    =$popularProduct->discount_price;
       }

       $bestSellerProducts=Product::where('status',1)->orderBy('bestseller','desc')->take(8)->get();
       $bestSellerRes=[];
       foreach ($bestSellerProducts as $key=> $bestSellerProduct){
           $bestSellerRes[$key]['id']       =$bestSellerProduct->id;
           $bestSellerRes[$key]['name']     =$bestSellerProduct->name;
           $bestSellerRes[$key]['image']    =asset($bestSellerProduct->image);
//           $bestSellerRes[$key]['image1']   =asset(Subimage::where('product_id',$bestSellerProduct->id)->first()->image);
           $bestSellerRes[$key]['price']    =$bestSellerProduct->discount_price;
       }
       $specialProducts=Product::where('status',1)->where('special_status',1)->orderBy('id','desc')->take(8)->get();
       $specialProductsRes=[];
       foreach ($specialProducts as $key=>  $specialProduct){
           $specialProductsRes[$key]['id']       =$specialProduct->id;
           $specialProductsRes[$key]['name']     =$specialProduct->name;
           $specialProductsRes[$key]['image']    =asset($specialProduct->image);
//           $specialProductsRes[$key]['image1']   =asset(Subimage::where('product_id',$specialProduct->id)->first()->image);
           $specialProductsRes[$key]['price']    =$specialProduct->discount_price;
       }
       $newProducts=Product::where('status',1)->orderBy('id','desc')->take(8)->get();
       $newProductsRes=[];
       foreach ($newProducts as $key=>  $newProduct){
           $newProductsRes[$key]['id']       =$newProduct->id;
           $newProductsRes[$key]['name']     =$newProduct->name;
           $newProductsRes[$key]['image']    =asset($newProduct->image);
//           $newProductsRes[$key]['image1']   =asset(Subimage::where('product_id',$newProduct->id)->first()->image);
           $newProductsRes[$key]['price']    =$newProduct->discount_price;
       }
       $result=[
           0=>[
               'name'=>'popularProduct',
               'products'=>$popularRes
               ],
           1=>[
               'name'=>'Best Product',
               'products'=>$bestSellerRes
           ],
           2=>[
               'name'=>'Special Product',
               'products'=>$specialProductsRes
           ],
           3=>[
               'name'=>'New Product',
               'products'=>$newProductsRes
           ],


       ];
       return response()->json($result);
   }
   public function getAllCategory(){
       $categories=Category::where('catStatus',1)->get(['id','CatName']);
       $result=[];
       foreach ($categories as $key=>$category ){
           $temp=[];
           $subCategories=SubCategory::where('category_id',$category->id)->get(['id','cat_name']);
           foreach ($subCategories as $key1=>$subCategory){
               $temp[$key1]['id']        =$subCategory->id;
               $temp[$key1]['cat_name']  = $subCategory->cat_name;
           }
           $result[$key]['id']=$category->id;
           $result[$key]['name']=$category->CatName;
           $result[$key]['sub_category']=$temp;

       }
       return response()->json($categories);
   }
}
