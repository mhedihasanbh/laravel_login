@extends('master');
@section('tittle')
    Edit|Product
@endsection
@section('body')
    <div class="row">


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Product Form</h4>
                    @if($message=Session::get('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{route('update-product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Category name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="category_id" onchange="getSubcategoryInfo(this.value)">
                                            <option disabled selected>------Select category name------</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$product->category_id==$category->id ?'selected':''}}> {{$category->CatName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label"> Sub Category name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="sub_category_id" id="subCategoryId">
                                            <option>------Select Subcategory name------</option>
                                            @foreach($subcategiries as $subcategory )
                                                <option value="{{$subcategory->id}}" {{$product->sub_category_id==$subcategory->id ?'selected':''}}>{{$subcategory->cat_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Brand name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="brand_id">
                                            <option>------Select Brand name------</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}" {{$product->brand_id==$brand->id ?'selected':''}}>{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Unit name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="unit_id">
                                            <option>------Select Unit name------</option>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}" {{$product->unit_id==$unit->id ?'selected':''}}>{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Color name</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control select2-multiple" name="color[]" multiple="multiple" data-placeholder="Choose ...">
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}" @foreach($productcolors as $productcolor) @if($productcolor->color_id==$color->id) selected @endif @endforeach>{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Size name</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control select2-multiple" name="size[]" multiple="multiple" data-placeholder="Choose ...">
                                            @foreach($sizes as $size)
                                                <option value="{{$size->id}}" @foreach($productsizes as $productsize) @if($productsize->size_id==$size->id) selected @endif @endforeach>{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input2" class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="name" value="{{$product->name}}" class="form-control" id="horizontal-firstname-input">
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input3" class="col-sm-3 col-form-label">Product Code</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="code" value="{{$product->code}}" class="form-control" id="horizontal-firstname-input3">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input3" class="col-sm-3 col-form-label">Product Price</label>
                                    <div class="col-sm-9">

                                        <div class="input-group">

                                            <input type="text" name="main_price" value="{{$product->main_price}}" placeholder="Main-price" aria-label="First name" class="form-control">
                                            <input type="text" name="discount_price" value="{{$product->discount_price}}" placeholder="Discount-price" aria-label="Last name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input22" class="col-sm-3 col-form-label">short Description</label>
                                    <div class="col-sm-9">
                                        <textarea  name="short_description" class="form-control" id="horizontal-email-input22">{{$product->short_description}} </textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="horizontal-password-input55" class="col-sm-3 col-form-label">Main Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="main_image" accept="image/*" class="form-control-file" id="horizontal-password-input55">
                                        <img src="{{asset($product->image)}}" width="100" height="100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-password-input55" class="col-sm-3 col-form-label">Sub Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="sub_image[]" accept="image/*" multiple class="form-control-file" id="horizontal-password-input55">
                                @foreach($subImages as $subImage)
                                    <img src="{{asset($subImage->image)}}" width="100" height="100" />
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row mb-4">

                                    <div class="col-sm-12">
                                        <textarea  name="long_description" class="summernote" id="horizontal-email-input23"> {{$product->short_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row mb-4">
                            <label for="horizontal-password-input1" class="col-sm-3 col-form-label">Publication Status</label>
                            <div class="col-sm-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{$product->status==1?'checked':''}} name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Publish</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{$product->status==0?'checked':''}} name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">UnPublish</label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12">


                                <div>
                                    <button type="submit" class="btn btn-primary btn-block w-md">Update Product Info</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
