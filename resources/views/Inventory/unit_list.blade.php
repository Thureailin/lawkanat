@extends('master')

@section('title','Counting Unit List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Counting Unit List</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Counting Unit List</h2>
    </div>
</div>


<div class="row">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">{{$item->item_name}}'s Option List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Estimate Cost Price</th>
                                <th>Sale Price</th>
                                <th>Ingredient Lists</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>

                            @foreach($units as $unit)
                            <tr>
                                <td>{{$i++}}</td>

                                <td style="overflow:hidden;white-space: nowrap;">{{$unit->name}}</td>

                                @if($unit->size == 1)
                                <td>Small</td>
                                @elseif($unit->size == 2)
                                <td>Normal</td>
                                @else
                                <td>Large</td>
                                @endif

                                <td>{{$unit->est_cost_price}}</td>

                                <td>{{$unit->sale_price}}</td>

                                <td>
                                    @foreach($unit->ingredient as $ingre)

                                    {{$ingre->name}}<br>

                                    @endforeach
                                </td>

                                <td style="text-overflow: ellipsis; white-space: nowrap;" class="text-center">

                                    @if ($unit->brake_flag == 2)
                                    <a href="{{route('unbrake_status',$unit->id)}}" class="btn btn-danger">Unbrake</a>
                                    @else
                                    <a href="{{route('brake_status',$unit->id)}}" class="btn btn-success">Brake</a>
                                    @endif

                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_item{{$unit->id}}">
                                    Edit</a>

                                    {{-- <a href="{{route('edit_unit_ingredient', $unit->id)}}" class="btn btn-secondary">
                                    Edit Ingredients</a> --}}

                                    <a href="#" class="btn btn-danger" onclick="ApproveLeave('{{$unit->id}}')">
                                        <i class="mdi mdi-delete"></i>
                                        Delete
                                    </a>
                                </td>

                                <div class="modal fade" id="edit_item{{$unit->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Counting Unit Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                    <div class="modal-body">
                                        <form class="form-material" method="post" action="{{route('option_update',$unit->id)}}">
                                            @csrf

                                            <div class="form-group">
                                                <label class="font-weight-bold">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{$unit->name}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Customer Sale Price</label>
                                                <input type="number" name="sale_price" class="form-control" value="{{$unit->sale_price}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Estimate Cost Price</label>
                                                <input type="number" name="est_cost_price" class="form-control" value="{{$unit->est_cost_price}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Select Size</label>
                                                <select class="form-control select2 m-b-10" name="size" style="width: 100%" >
                                                    <option value="1"
                                                    @if ($unit->size==1)
                                                        selected
                                                    @endif
                                                    >Small</option>
                                                    <option value="2"
                                                    @if ($unit->size==2)
                                                    selected
                                                    @endif
                                                    >Normal</option>
                                                    <option value="3"
                                                    @if ($unit->size==3)
                                                    selected
                                                    @endif
                                                    >Large</option>

                                                </select>
                                            </div>

                                            <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Update Counting Unit">
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


    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">Option Create Form</h3>
                <form class="form-material" method="post" action="{{route('option_store')}}">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="item_id">


                    <div class="form-group">
                        <label class="font-weight-bold">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Option Name" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Customer Sale Price</label>
                        <input type="number" name="sale_price" class="form-control" placeholder="Enter Customer Sale Price" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Estimate Cost Price</label>
                        <input type="number" name="est_cost_price" class="form-control" placeholder="Enter Customer Sale Price" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Select Size</label>
                        <select class="form-control select2 m-b-10" name="size" style="width: 100%" >
                            <option value="">Select Meal</option>
                            <option value="1">Small</option>
                            <option value="2">Normal</option>
                            <option value="3">Large</option>

                        </select>
                    </div>


                    {{-- <div id="education_fields">
                    <div class="row">
                    <div class="col-sm-4">
                    <label>Ingredient</label>
                    </div>
                    <div class="col-sm-3">
                    <label>Unit</label>
                    </div>
                    <div class="col-sm-3">
                    <label>Amount</label>
                    </div>
                    <div class="col-sm-2">
                    <label>Action</label>
                    </div>
                    </div>
                    </div> --}}

                    <div class="form-group">
                        {{-- <button type="button" class="btn btn-info float-right mb-3" data-toggle="modal" data-target="#add_item">
                            <i class="fa fa-plus"></i> Add Ingredient
                        </button> --}}

                        <div class="modal fade" id="add_item" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Add Ingredient</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="#close_modal">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                    <label>Ingredient</label>
                                        <select class="form-control select2 m-b-10" style="width: 100%" id="ingredient" onchange="fillIngreInfo(this.value)">
                                        <option>Select Ingredient</option>
                                            @foreach($ingredient_lists as $list)
                                            <option value="{{ $list->id}}-{{$list->name}}-{{$list->unit}}-{{$list->instock_quantity}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                        <label>Unit</label>
			                            <input class="form-control" type="text" placeholder="Enter Unit" id="unit">
                                        <label>In-stock Quantity</label>
			                            <input class="form-control" type="number" placeholder="Enter In-stock qty" id="instock" >
                                        <label>Amount</label>
			                    <input class="form-control" type="number" placeholder="Enter Amount" id="amount" >



                                        <div class="form-actions mt-3">
                                          <button type="submit" class="btn btn-success" id="add"> <i class="fa fa-check"></i> Save</button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save Unit">
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
    });

    function ApproveLeave(value){

        var unit_id = value;

        swal({
            title: "Are You Sure Want To Delete?",
            icon:'warning',
            buttons: ["NO", "YES"]
        })

      .then((isConfirm)=>{

        if(isConfirm){

          $.ajax({
              type:'POST',
                url:'delete',
                dataType:'json',
                data:{
                  "_token": "{{ csrf_token() }}",
                  "unit_id": unit_id,
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

    var count = 0;

    $('#add').click(function(event){

        event.preventDefault();

        var html = "";

        count = count + 1;

        var item_price = $('#amount').val();


        var unit = $('#unit').val();
        var item_currency = $('#ingredient').val();

        var item = item_currency.split("-");


        if($.trim(item_price) == '' || $.trim(item_currency) == '' )
        {
            swal({

                title:"Failed!",
                text:"Please fill all basic unit field",
                icon:"info",
                timer: 3000,
            });

        }else{

            html+=`<div class="form-group" id="removeclass_${count}">
                        <div class="row">

                        <div class="col-sm-4">
                                <div class="form-group">


                                    <input type="hidden" name="ingredient[]" value="${item[0]}">
                                    <input type="text" class="form-control" value="${item[1]}">

                                </div>
                            </div>


                            <div class="col-sm-3">

                            <input type="text" class="form-control" value="${unit}">
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">

                                    <input type="text" class="form-control" name="amount[]" value="${item_price}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-danger" type="button" onclick="remove_education_fields(${count});">
                                    <i class="fa fa-minus"></i>

                                </button>
                            </div>
                        </div>
                   </div>`

            $("#education_fields").append(html);

            formClear();
        }

   });

    function remove_update_education_fields(rid) {

        console.log(rid);

        $('#removeclass2_' + rid).remove();
    }

    function remove_education_fields(rid) {

        console.log(rid);

        $('#removeclass_' + rid).remove();
    }

    function formClear() {

        $("#amount").val("");

        $('#add_item').modal('hide');
    }

    function fillIngreInfo(value){

        var str = value;
        var info = str.split("-");
        // alert(info);
        $("#unit").val(info[2]);
        $("#instock").val(info[3]);
    }
    function test(){
        alert("success");
    }



</script>

@endsection
