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
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Products Here</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>Product-Name</th>
                            <th>Product Image</th>
                            <th>Category Name</th>
                            <th>Main Price</th>
                            <th>Discount Price</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($products as $product)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td><img src="{{asset($product->image)}}" alt="{{$product->name}}" width="140" height="180"></td>
                                <td>{{$product->category->CatName}}</td>
                                <td>{{$product->main_price}}</td>
                                <td>{{$product->discount_price}}</td>

                                <td>{{$product->status == 1 ? 'published':'Unplulished'}}</td>
                                <td>
                                    @if($product->status == 1)
                                        <a href="{{route('update-product-status',['id'=> $product->id])}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @else
                                        <a href="{{route('update-product-status',['id'=> $product->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @endif
                                        <a href="{{route('view-product-details',['id'=> $product->id])}}" class="btn btn-info btn-sm">
                                            <i class="fas fa-book-open"></i>

                                        </a>
                                    <a href="{{route('edit-product',['id'=> $product->id])}}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>

                                    </a>
                                    <a href="{{route('delete-product',['id'=> $product->id])}}" onclick="return confirm('Are You Sure Delete This...')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>

                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
