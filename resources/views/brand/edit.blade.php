@extends('master');
@section('tittle')
    Manage|category
@endsection
@section('head')
    <link href="{{asset('/')}}assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/')}}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/')}}assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
@endsection
@section('body')
    <div class="row">


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add Brand</h4>
                    @if($message=Session::get('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{route('update-brand')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Create New Brand</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$brand->brand_name}}" name="brand_name" class="form-control" id="horizontal-firstname-input">
                                <input type="hidden" name="id" value="{{$brand->id}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Brand Descraption</label>
                            <div class="col-sm-9">
                                <textarea  name="brand_descraption" class="form-control" id="horizontal-email-input">{{$brand->brand_descraption}} </textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-password-input" class="col-sm-3 col-form-label">Brand Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="brand_image" class="form-control-file" id="horizontal-password-input">
                                <img src="{{asset($brand->brand_image)}}" height="50" width="80">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="horizontal-password-input1" class="col-sm-3 col-form-label">Publication Status</label>
                            <div class="col-sm-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$brand->status==1?'checked':''}} type="radio" checked name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Publish</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$brand->status==0?'checked':''}} type="radio" name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">UnPublish</label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">


                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Update brand</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title -->

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

                    <h4 class="card-title">All Brands Here</h4>
                    <p class="card-title-desc">DataTables has most features enabled by
                        default, so all you need to do to use it with your own tables is to call
                        the construction function: <code>$().DataTable();</code>.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>CateGory-Name</th>
                            <th>Category_Descraption</th>
                            <th>Category_image</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$brand->brand_name}}</td>
                                <td>{{$brand->brand_descraption}}</td>
                                <td><img src="{{asset($brand->brand_image)}}" height="60" width="90"></td>
                                <td>{{$brand->catStatus == 1 ? 'published':'Unplulished'}}</td>
                                <td>
                                    @if($brand->catStatus==1)
                                        <a href="{{route('update-brand-status',['id'=> $brand->id])}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @else
                                        <a href="{{route('update-brand-status',['id'=> $brand->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @endif
                                    <a href="{{route('edit-category',['id'=> $brand->id])}}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>

                                    </a>
                                    <a href="{{route('delete-category',['id'=> $brand->id])}}" onclick="return confirm('Are You Sure Delete This...')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>

                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
