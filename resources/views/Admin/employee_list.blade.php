@extends('master')

@section('title','Employee List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Employee List</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Employee List</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Employee List</h2>
    </div>

    <div class="col-md-7 col-4 align-self-center">

        <div class="d-flex m-t-10 justify-content-end">
             <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create_item">
                <i class="fas fa-plus"></i>
                Add Employee
            </a>
        </div>

        <div class="modal fade" id="create_item" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Employee Create Form</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>

                    <div class="modal-body">
                        <form class="form-material" method="post" action="{{route('employee_store')}}" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Employee Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Employee's Phone</label>
                                            <input type="text" name="phone" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Employee's Address</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class=" col-md-9">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-inverse">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <!-- .col -->
    @foreach($employee as $emp)
    <div class="col-md-6 col-lg-6 col-xlg-4">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3 text-center">
                    <a href="#">
                        <img src="{{asset('image/'. $emp->photo_path)}}" alt="user" class="img-circle img-responsive">
                    </a>
                </div>
                <div class="col-md-8 col-lg-9 m-l-3">
                    <h3 class="box-title m-b-0">{{$emp->name}}</h3>
                        <small>Role -> Employee</small>

                    <address>
                        {{$emp->email}}
                        <br/>
                        <br/>
                        <abbr title="Phone"><i class="fas fa-2x fa-phone-square"> {{$emp->phone}}</i></abbr>
                    </address>

                     <a href="{{route('employee_details',$emp->id)}}" class="btn btn-sm btn-primary float-right">
                        <i class="fas fa-check-circle"></i>
                        Check Employee Details
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- /.col -->
</div>

@endsection
