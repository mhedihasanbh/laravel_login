<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
//    public function categories(){
//
//      return $this->belongsTo('App\Models\Category');
//    }
public function Category(){
    return $this->belongsTo('App\Models\Category');
}
}
