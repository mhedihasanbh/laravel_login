@extends('master');
@section('tittle')
    Manage|Size
@endsection
@section('body')
    <div class="row">


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add Size </h4>
                    @if($message=Session::get('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{route('size.store')}}" method="post" >
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Size  name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="horizontal-firstname-input">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Size  code</label>
                            <div class="col-sm-9">
                                <input type="text" name="code" class="form-control" id="horizontal-firstname-input">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Size  Descraption</label>
                            <div class="col-sm-9">
                                <textarea  name="descraption" class="form-control" id="horizontal-email-input"> </textarea>
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
                                    <button type="submit" class="btn btn-primary w-md">add new Size </button>
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

                    <h4 class="card-title">All Size  Here</h4>
                    <p class="card-title-desc">DataTables has most features enabled by
                        default, so all you need to do to use it with your own tables is to call
                        the construction function: <code>$().DataTable();</code>.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SI-NO</th>
                            <th>Size -Name</th>
                            <th>Size  Code</th>
                            <th>Size  Descraption</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($sizes as $key=>$size)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$size->name}}</td>
                                <td>{{$size->code}}</td>
                                <td>{{$size->descraption}}</td>

                                <td>{{$size->status == 1 ? 'published':'Unplulished'}}</td>
                                <td>
                                    @if($size->status==1)
                                        <a href="{{route('update-size-status',['id'=> $size->id])}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @else
                                        <a href="{{route('update-size-status',['id'=> $size->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    @endif
                                    <a href="{{route('size.edit',$size)}}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>

                                    </a>
                                    <a href="" onclick="event.preventDefault();document.getElementById('sizeDelete'+{{$key}}).submit()" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>

                                    </a>
                                    <form action="{{route('size.destroy',$size->id)}}" method="POST" id="sizeDelete{{$key}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">

                                    </form>
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

