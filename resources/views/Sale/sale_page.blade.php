@extends('master')

@section('title','Shop Order Page')

@section('place')

<!--<div class="col-md-5 col-8 align-self-center">-->
<!--    <h3 class="text-themecolor m-b-0 m-t-0">Shop Order Page</h3>-->
<!--    <ol class="breadcrumb">-->
<!--        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>-->
<!--        <li class="breadcrumb-item active">Shop Order Page</li>-->
<!--    </ol>-->
<!--</div>-->

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-10 col-10 align-self-center">
        <h2 class="font-weight-bold">Shop Order</h2>
    </div>

    {{-- <div class="cold-md-2 pull-right">
        <a href="{{route('shop_order_sale', 0)}}" class="btn btn-outline-primary float-right">Take Away Order</a>
    </div> --}}
</div>

<div class="row">
    <div class="col-md-3">
        <label class="font-weight-bold">Filter By Floor</label>
        <select class="form-control mr-2" style="width: 100%" onchange="searchByFloor(this.value)" id="floor">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="font-weight-bold">Filter By Table Type</label>
        <select class="form-control mr-2" style="width: 100%" onchange="searchByTableType(this.value)" disabled id="table_type">
            @foreach($table_types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
    <label class="font-weight-bold">Choose shop or delivery</label>
    <div class="dropdown">
  <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Shop
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <a class="dropdown-item" href="{{route('delivery')}}">Delivery</a>

  </div>
</div>

    </div>


    <div class="card shadow mt-3">
        <div class="card-body">
            <ul class="nav nav-pills m-t-30 m-b-30">

                <li class="nav-item">
                    <a href="#navpills-2" class="nav-link active" data-toggle="tab" aria-expanded="false">Graphical View</a>
                </li>

                <li class=" nav-item">
                    <a href="#navpills-1" class="nav-link" data-toggle="tab" aria-expanded="false">List View</a>
                </li>
            </ul>

            <div class="tab-content br-n pn">

                <div id="navpills-1" class="tab-pane ">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Table Number</th>
                                            <th>Floor</th>
                                            <th>Table Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i=1;?>
                                        @foreach($table_lists as $table)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$table->table_number}}</td>
                                            <td>{{$table->floor}}</td>
                                            <td>{{$table->table_type->name}}</td>
                                            <td><a href="{{route('shop_order_sale', $table->id)}}" class="btn btn-outline-primary">Go To Shop Order Page</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="navpills-2" class="tab-pane active">
                    <div class="row" id="table_list_2">
                        @foreach($table_lists as $table)
                            <div class="col-4">
                                <a href="{{route('shop_order_sale', $table->id)}}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="round round-lg m-2 align-self-center">
                                                    <i class="mdi mdi-food"></i>
                                                </div>
                                                <div class="m-l-10 align-self-center">
                                                    <h4 class="m-b-1 font-lgiht" style="margin-top:30px;">Table Number -
                                                        @if($table->status == 1)
                                                        <span class="badge-pill badge-success">{{$table->table_number}}</span>
                                                        <img src="{{asset('image/tablephoto3.jpg')}}" width="100" height="50">
                                                         @elseif($table->status == 2)
                                                        <span class="badge-pill badge-warning">{{$table->table_number}}</span>
                                                        <img src="{{asset('image/tablephoto1.jpg')}}" width="100" height="50">
                                                        @else
                                                        <span class="badge-pill" style='background-color:lightgreen;color:white;'>{{$table->table_number}}</span>
                                                        <img src="{{asset('image/tablephoto2.jpg')}}" width="100" height="50">
                                                        @endif
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>

    function searchByFloor(floor_id){

        var html = "";

        $.ajax({

           type:'POST',

           url:'/getTableByFloor',

           data:{
            "_token":"{{csrf_token()}}",
            "floor_id":floor_id,

           },

            success:function(data){

                if ($.trim(data)){

                    $("#table_list_2").empty();

                    $.each(data, function(i, table) {

                        var url = ' {{route("shop_order_sale", ":table_id")}} ';

                        url = url.replace(':table_id', table.id);

                        var status = table.status;

                        if (status === 1) {

                          greeting = 'class="badge-pill badge-success"';

                        } else {

                          greeting = 'class="badge-pill badge-warning"';
                        }


                        html+=`<div class="col-4">
                                    <a href="${url}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-row">
                                                    <div class="round round-lg m-2 align-self-center">
                                                        <i class="mdi mdi-food"></i>
                                                    </div>
                                                    <div class="m-l-10 align-self-center">
                                                        <h4 class="m-b-1 font-lgiht">Table Number -
                                                            <span ${greeting} > ${table.table_number} </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>`;
                    });

                    $("#table_list_2").html(html);

                    $("#table_type").prop( "disabled", false );
                }
            }
        });
    }


    function searchByTableType(table_type){

        var html = "";

        var floor = $("#floor").val();

         $.ajax({

           type:'POST',

           url:'/getTableByTableType',

           data:{
            "_token":"{{csrf_token()}}",
            "floor_id":floor,
            "table_type":table_type,

           },

            success:function(data){

               if ($.trim(data)){

                    $("#table_list_2").empty();

                    $.each(data, function(i, table) {

                        var url = ' {{route("shop_order_sale", ":table_id")}} ';

                        url = url.replace(':table_id', table.id);

                        var status = table.status;

                        if (status === 1) {

                          greeting = 'class="badge-pill badge-success"';

                        } else {

                          greeting = 'class="badge-pill badge-warning"';
                        }


                        html+=`<div class="col-4">
                                    <a href="${url}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-row">
                                                    <div class="round round-lg m-2 align-self-center">
                                                        <i class="mdi mdi-food"></i>
                                                    </div>
                                                    <div class="m-l-10 align-self-center">
                                                        <h4 class="m-b-1 font-lgiht">Table Number -
                                                            <span ${greeting} > ${table.table_number} </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>`;
                    });

                    $("#table_list_2").html(html);

                    $("#table_type").prop( "disabled", false );
                }
            }
        });
    }

</script>
@endsection
