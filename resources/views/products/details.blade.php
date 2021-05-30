@extends('master');
@section('tittle')
    Manage|Product
@endsection
@section('body')
    @if($message=Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Data Tables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Tables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Products Here</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <tr>
                            <td>Product id</td>
                            <td>{{$product->id}}</td>
                        </tr>
                        <tr>
                            <td>Product Name</td>
                            <td>{{$product->name}}</td>
                        </tr>
                        <tr>
                            <td>Product Code</td>
                            <td>{{$product->code}}</td>
                        </tr>
                        <tr>
                            <td>Category Name</td>
                            <td>{{$product->category->CatName}}</td>
                        </tr>
                        <tr>
                            <td> Sub Category Name</td>
                            <td>{{isset($product->subcategory->cat_name) ? $product->subcategory->cat_name :''}}</td>
                        </tr>
                        <tr>
                            <td> Brand Name</td>
                            <td>{{$product->brand->brand_name}}</td>
                        </tr>
                        <tr>
                            <td> Unit Name</td>
                            <td>{{$product->unit->name}}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{{$product->short_description}}</td>
                        </tr>
                        <tr>
                            <td>Long Description</td>
                            <td>{!! $product->long_description !!}</td>
                        </tr>
                        <tr>
                            <td>Main Price</td>
                            <td>{{$product->main_price}}</td>
                        </tr>
                        <tr>
                            <td>Discount Price</td>
                            <td>{{$product->discount_price}}</td>
                        </tr>
                        <tr>
                            <td>Main Image</td>
                            <td><img src="{{asset($product->image)}}" width="200" height="150"></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Products Color Name</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>Color-Name</th>

                        </tr>
                        </thead>


                        <tbody>
                        @foreach($productcolors as $productcolor)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$productcolor->color->name}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Products Size Info</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>Size-Name</th>

                        </tr>
                        </thead>


                        <tbody>
                        @foreach($productsizes as $productsize)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$productsize->size->name}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Products SubI mage Info</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>SubImage-Name</th>

                        </tr>
                        </thead>


                        <tbody>

                        @foreach($subImages as $subImage)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset($subImage->image)}}" width="200" height="200"/></td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
