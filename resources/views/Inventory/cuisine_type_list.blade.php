@extends('master')

@section('title','Main Menu List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Main Menu List</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Main Menu List</h2>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Main Menu List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Related Meal Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=1;?>
                            @foreach($cuisine_type_lists as $cuisine)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$cuisine->name}}</td>
                                <td>{{$cuisine->meal->name}}</td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_item{{$cuisine->id}}"><i class="far fa-edit"></i>
                                    Edit</a>
                                </td>

                                <div class="modal fade" id="edit_item{{$cuisine->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Main Menu Form</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>

                                    <div class="modal-body">
                                        <form class="form-material" method="post" action="{{route('cuisine_type_update', $cuisine->id)}}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="font-weight-bold">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{$cuisine->name}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Meal</label>
                                                <select class="form-control select2 m-b-10" name="meal_id">
                                                    @foreach($meal_lists as $meal)
                                                    <option value="{{$meal->id}}" @if($cuisine->meal_id === $meal->id) selected='selected' @endif>{{$meal->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Update">
                                        </form>
                                    </div>

                              </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">Main Menu Create Form</h3>
                <form class="form-material m-t-40" method="post" action="{{route('cuisine_type_store')}}">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Name</label>
                        <input type="text" name="name" class="form-control @error('category_name') is-invalid @enderror" placeholder="Enter Main Menu Name" required>

                        @error('category_name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Choose Meal</label>
                        <select class="form-control select2 m-b-10" name="meal_id" style="width: 100%" >
                            <option value="">Select Meal</option>
                            @foreach($meal_lists as $meal)
                            <option value="{{$meal->id}}">{{$meal->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save Category">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
