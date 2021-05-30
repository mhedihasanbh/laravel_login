@extends('master');
@section('tittle')
    Manage SUB|category
@endsection
@section('body')
    <div class="row">


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">SUB category Form</h4>
                    @if($message=Session::get('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{route('new-sub-category')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Category name</label>
                            <div class="col-sm-9">
                               <select class="form-control" name="category_id">
                                   <option>---Select category Name-----</option>
                                   @foreach($categories as $category)
                                       <option value="{{$category->id}}">{{$category->CatName}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label"> Create Sub Category </label>
                            <div class="col-sm-9">
                                <input type="text" name="cat_name" class="form-control" id="horizontal-firstname-input">
                                <span class="text-danger">{{$errors->has('cat_name')?$errors->first('cat_name'):''}}</span>
                            </div>

                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label"> SUB Category Descraption</label>
                            <div class="col-sm-9">
                                <textarea  name="cat_descraption" class="form-control" id="horizontal-email-input"> </textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-password-input" class="col-sm-3 col-form-label"> SUB Category Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="cat-image" class="form-control-file" id="horizontal-password-input">
                                <span class="text-danger">{{$errors->has('cat-image')?$errors->first('cat-image'):''}}</span>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="horizontal-password-input1" class="col-sm-3 col-form-label">Publication Status</label>
                            <div class="col-sm-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" checked name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Publish</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">UnPublish</label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">


                                <div>
                                    <button type="submit" class="btn btn-primary w-md">add new SUB category</button>
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

                    <h4 class="card-title">All categories Here</h4>
                    <p class="card-title-desc">DataTables has most features enabled by
                        default, so all you need to do to use it with your own tables is to call
                        the construction function: <code>$().DataTable();</code>.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>CateGory-Name</th>
                            <th>SUB-Category-Name</th>
                            <th> SUB-Category-Descraption</th>
                            <th>SUB-Category-image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($subCategories as $subCategory)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$subCategory->Category->CatName}}</td>
                                <td>{{$subCategory->cat_name}}</td>
                                <td>{{$subCategory->cat_descraption}}</td>
                                <td>
                                    <img src="{{asset($subCategory->cat_image)}}" height="80" width="120" />
                                </td>
                                <td>{{$subCategory->status==1?'publish':'unpublish'}}</td>
                                <td>
                                    @if($subCategory->catStatus==1)
                                        <a href="{{route('update-sub-category-status',['id'=> $subCategory->id])}}" class="btn btn-success btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @else
                                        <a href="{{route('update-sub-category-status',['id'=> $subCategory->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @endif
                                    <a href="{{route('edit-sub-category',['id'=> $subCategory->id])}}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>

                                    </a>
                                    <a href="{{route('delete-sub-category',['id'=> $subCategory->id])}}" onclick="return confirm('Are You Sure Delete This...')" class="btn btn-danger btn-sm">
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
