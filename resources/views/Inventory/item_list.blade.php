@extends('master')

@section('title','Menu Item List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Menu Item List</li>
    </ol>
</div>

@endsection

@section('content')

<style>

    th {
        overflow:hidden;
        white-space: nowrap;
    }


</style>

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Menu Item List</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card shadow" style="height: 600px;overflow:scroll;">
            <div class="card-body">
                {{-- <h4 class="card-title">Menu Item List</h4> --}}
                <div class="table-responsive">
                    <table class="table" id="example23">
                        <thead>
                            <tr>
                                <th>Menu Item Code</th>
                                <th>Menu Item Name</th>
                                <th>Customer Console</th>
                                <th>Related Cuisine & Meal</th>
                                <th>Check Option List</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($menu_item_lists as $item)
                            <tr>
                                <td>{{$item->item_code}}</td>
                                <td>{{$item->item_name}}</td>
                                @if($item->customer_console == 0)
                                <td class="text-success">Show To Customer</td>
                                @else
                                <td class="text-warning">Do Not Show To Customer</td>
                                @endif

                                <td>{{$item->cuisine_type->name}} / {{$item->cuisine_type->meal->name}}</td>
                                <td>
                                    <a href="{{route('option_list',$item->id)}}" class="btn btn-info">
                                    Check</a>
                                </td>

                                <td class="text-center" style="text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_item{{$item->id}}">
                                        Edit Item
                                    </a>
                                    <a href="#" class="btn btn-danger deletemenu">
                                        <i class="mdi mdi-delete"></i>
                                        Delete
                                    </a>
                                    <form action="{{route('menu.delete')}}" method="POST" class="deletemenuItem">
                                    @csrf
                                    <input type="hidden" value="{{$item->id}}" name="item_id">
                                    </form>
                                </td>

                                <div class="modal fade" id="edit_item{{$item->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Cuisine Type Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form class="form-material" method="post" action="{{route('menu_item_update', $item->id)}}" enctype='multipart/form-data'>
                                                    @csrf

                                                     <div class="form-group">
                                                        <label class="font-weight-bold">Code</label>
                                                        <input type="text" name="code" class="form-control" value="{{$item->item_code}}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{$item->item_name}}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Item's Photo</label>
                                                        <input type="file" name="photo_path" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Cuisine & Meal</label>
                                                        <select class="form-control select2 m-b-10" name="cuisine_type_id" style="width: 100%">
                                                            @foreach($cuisine_type_lists as $cuisine)
                                                            <option value="{{$cuisine->id}}" @if($item->cuisine_type_id === $cuisine->id) selected='selected' @endif>{{$cuisine->name}} / {{$cuisine->meal->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-gropu">
                                                         <label class="control-label">Customer Console</label>
                                                            <div class="switch">
                                                                <label>OFF
                                                                    <input type="checkbox" checked name="customer_console"><span class="lever"></span>ON</label>
                                                            </div>
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

    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">Menu Item Create Form</h3>
                <form class="form-material m-t-40" method="post" action="{{route('menu_item_store')}}" enctype='multipart/form-data'>
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Menu Item Code</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Menu Item Code" required>

                        @error('code')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Menu Item Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Menu Item Name" required>

                        @error('name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="control-label">Item's Photo</label>
                        <input type="file" name="photo_path" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Choose Cuisine & Meal</label>
                        <select class="form-control select2 m-b-10" name="cuisine_type_id" style="width: 100%" >
                            <option value="">Select Cuisine Type</option>
                            @foreach($cuisine_type_lists as $cuisine)
                            <option value="{{$cuisine->id}}">{{$cuisine->name}} - {{$cuisine->meal->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-gropu">
                         <label class="control-label">Customer Console</label>
                            <div class="switch">
                                <label>OFF
                                    <input type="checkbox" checked name="customer_console"><span class="lever"></span>ON</label>
                            </div>
                    </div>

                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save Category">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function(){

        $(".select2").select2();

        $('#example23').DataTable( {

            "paging":   false,
            "ordering": true,
            "info":     false,

        });
    });

    $('.deletemenu').click(function(){
        $('.deletemenuItem').submit();
    })

    function ApproveLeave(value){

        var item_id = value;

        swal({
            title: "Are You Sure Want To Delete?",
            icon:'warning',
            buttons: ["NO", "YES"]
        })

      .then((isConfirm)=>{

        if(isConfirm){

          $.ajax({
              type:'POST',
                url:'item/delete',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "item_id": item_id,
                },

              success: function(){

                      swal({
                            title: "Success!",
                            text : "Successfully Deleted!",
                            icon : "success",
                        });

                        setTimeout(function(){
               window.location.reload();
            }, 1000);


                    },
                });
        }
      });


    }

</script>
@endsection
