@extends('customer_master')

@section('title','Shop Order Sale Page')

@section('place')

    <!--<div class="col-md-5 col-8 align-self-center">-->



    <!--    <h3 class="text-themecolor m-b-0 m-t-0">Order Sale Page</h3>-->


    <!--    <ol class="breadcrumb">-->
    <!--        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>-->
    <!--        <li class="breadcrumb-item active">Order Sale Page</li>-->
    <!--        <div class="custom-control custom-switch" style="margin-left: 90px;">-->
    <!--            <input type="checkbox" class="custom-control-input" id="customSwitch2">-->
    <!--            <label class="custom-control-label text-info" for="customSwitch2">Take Away</label>-->
    <!--        </div>-->

    <!--    </ol>-->

    <!--</div>-->

@endsection

@section('content')

    <div class="row">

        <div class="card col-md-6">

            <form action="{{route('pending_lists')}}" method="post" id="vourcher_page">
                @csrf

                <input type="hidden" id="cus_complain" name="code_lists">


                <input type="hidden" id="item" name="option_lists">

                <input type="hidden" name="table_id" value="{{$table_number}}">

                <input type="hidden" name="take_away" id="t_away">

            </form>

            <form action="{{route('add_item')}}" method="post" id="add_more_item">
                @csrf
                <input type="hidden" id="add_complain" name="code_lists">

                <input type="hidden" id="option_lists" name="option_lists">

                <input type="hidden" id="order_id" name="order_id">

                <input type="hidden" name="take_away" id="t_add_away">

            </form>

            <form action="{{route('deli_add_item')}}" method="post" id="deli_add_more_item">
                @csrf
                <input type="hidden" id="add_deli_complain" name="code_lists">

                <input type="hidden" id="deli_option_lists" name="deli_option_lists">

                <input type="hidden" id="deli_order_id" name="deli_order_id">

            </form>

            <ul class="nav nav-tabs customtab" role="tablist">

                @foreach($cuisine_types as $cuisine)
                    <li class="nav-item" style="font-size:14px;">
                        <a class="nav-link" data-toggle="tab" href="#{{$cuisine->id}}" role="tab">

                    <span class="hidden-sm-up">
                        <i class="ti-home"></i>
                    </span>
                            <span class="hidden-xs-down">

                        {{$cuisine->name}}

                    </span>
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="1" role="tabpanel">

                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 1)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane" id="2" role="tabpanel">

                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 2)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane" id="3" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 3)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane" id="4" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 4)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane" id="5" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 5)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

                <div class="tab-pane" id="6" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 6)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane" id="7" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 7)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane" id="8" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 8)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane" id="9" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 9)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane" id="10" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 10)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane" id="11" role="tabpanel">
                    <div class="row mt-3">
                        @foreach($items as $item)
                            @if($item->cuisine_type_id == 11)

                                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                                    <img src="{{asset('/image/photo.jpg')}}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                                    <div style="height:40px;">
                                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                                    </div>


                                    <i class="btn btn-sm btn-success" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

                <div class="modal fade" id="remark_table_modal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-m" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Choose Remark Infomation</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="#close_modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body" id="remark_modal_body">
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" id="note_id">
                                    <div class="form-group">
                                        <label for="">Choose Codes</label>

                                        <select name="cus_remark"  class="form-control" style="width: 100%" data-placeholder="Select Codes"  id="select2" multiple="multiple"  onchange="fill_remark()">

                                            @foreach ($codes as $code)
                                                <option value="{{$code->id}}">{{$code->code}}-({{$code->name}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Remark</label>
                                        <textarea name="complain" id="complain" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-info" onclick="save_note()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="unit_table_modal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Choose Option Infomation</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="#close_modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body" id="checkout_modal_body">
                                <table class="table">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Item Name</th>
                                        <th>Unit Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="count_unit">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-6">

            <div class="card">
                @if($table == 0)
                    <h3 style="color:#49A8EF"><b>For Delivery<b></h3>
                @endif
                <div class="card-title">
                    <a href="" class="float-right" onclick="deleteItems()">Refresh Here &nbsp<i class="fas fa-sync"></i></a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="font-weight-bold text-info">Menu Item</th>
                                <th class="font-weight-bold text-info">Option</th>
                                <th class="font-weight-bold text-info">Quantity</th>
                                <th class="font-weight-bold text-info">Price</th>
                                <th class="font-weight-bold text-info">Note</th>
                            </tr>
                            </thead>
                            <tbody id="sale">
                            <tr>

                            </tr>
                            </tbody>
                            <tfoot>
                            <tr class="text-center">
                                <td class="font-weight-bold text-info" colspan="3">Total Quantity</td>
                                <td class="font-weight-bold text-info" id="total_quantity">0</td>
                            </tr>
                            <tr class="text-center">
                                <td class="font-weight-bold text-info" colspan="3">Sub Total Price</td>
                                <td class="font-weight-bold text-info" id="sub_total">0</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row ml-2 justify-content-center">
                        @if(isset($order) && $table==2)
                            <div class="col-md-2">
                                <i class="btn btn-success mr-2" onclick="DeliAddMoreItem({{$order->id}})"><i class="fas fa-plus"></i> Add More Item </i>
                            </div>
                        @elseif(isset($order))

                            <div class="col-md-2">
                                <i class="btn btn-success mr-2" onclick="AddMoreItem({{$order->id}})"><i class="fas fa-plus"></i> Add More Item </i>
                            </div>
                        @else

                            @if($table_number == 0)
                                <div class="col-md-2">
                                    <i class="btn btn-success mr-2"  data-toggle="modal" data-target="#myModal" onclick="storeoption()"><i class="fas fa-calendar-check"></i>Check Out</i>
                                </div>
                            @endif

                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><b>Delivery Information<b></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <form action="{{route('storedelivery')}}" method="post">
                                            @csrf
                                            <input type="hidden" id="cus_remark" name="code_lists">
                                            <input type="hidden" id="itemdeli" name="option_lists">
                                            <input type="hidden" id="totalqty" name="total_qty">


                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="usr">Name:</label>
                                                    <input type="text" class="form-control" id="name" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="usr">Phone:</label>
                                                    <input type="text" class="form-control" id="phone" name="phone">
                                                </div>
                                                <div class="form-group">
                                                    <label for="usr">Address:</label>
                                                    <input type="text" class="form-control" id="address" name="address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="usr">Township:</label>
                                                    <select class="form-control" name="township" id="township" onchange="deli_pay(this.value)">
                                                        <option value="">Select Township</option>
                                                        @foreach ($ygn_towns as $towns)
                                                            <option value="{{$towns->id}}">{{$towns->town_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" class="form-control" id="township" name="township"> --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="usr">Delivery Charges:</label>
                                                    <input type="text" class="form-control" id="deli_charges" name="deli_charges">
                                                </div>
                                                <div class="form-group">
                                                    <label for="usr">Order Date:</label>
                                                    <input type="date" class="form-control" id="orderdate" name="order_date" value="<?= date("Y-m-d"); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="usr">Note:</label>
                                                    <textarea class="form-control" rows="3" id="note" name="note"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" onclick="">Submit</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                    </div>

                                </div>
                            </div>
                            </form>
                            @if($table_number != 0)
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{route('pending_lists')}}">
                                        <i class="btn btn-success mr-2" ><i class="fas fa-calendar-check"></i> Check Out&nbsp;! </i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')

    <script type="text/javascript">

        $(document).ready(function() {
            $('#select2').select2();
            showmodal();
            $('#table_1').DataTable( {

                "paging":   false,
                "ordering": false,
                "info":     false,

            });

            $('#table_2').DataTable( {

                "paging":   false,
                "ordering": false,
                "info":     false,

            });

            $('#table_3').DataTable( {

                "paging":   false,
                "ordering": false,
                "info":     false,

            });
        });

        function deleteItems() {

            localStorage.clear();
        }


        function storeoption(){
            var mycart = localStorage.getItem('mycart');
            var grandTotal = localStorage.getItem('grandTotal');
            var myremark = localStorage.getItem('myremark');
            var grandTotal_obj = JSON.parse(grandTotal);
            $('#cus_remark').attr('value',myremark);
            $("#itemdeli").attr('value', mycart);
            $("#totalqty").attr('value',grandTotal_obj.total_qty);
            localStorage.clear();
        }



        function searchByCuisineOne(value){

            $('#table_1').empty();

            $.ajax({

                type:'POST',

                url:'/searchByCuisine',

                data:{
                    "_token":"{{csrf_token()}}",
                    "cuisine_id":value,
                },

                success:function(data){

                    var html = "";

                    $.each(data,function(i, v){

                        var id = v.id;

                        var item = v.item_name;

                        var photo_path =  '{{asset('/photo/Item/')}}'+ "/" + v.photo_path;

                        html+=`<tr>
                                <td>${item}</td>
                                <td>
                                    <img src="${photo_path}" class="img-rounded" width="100" height="70" />
                                </td>
                                <td class="text-center">
                                    <i class="btn btn-success" onclick="getCountingUnit(${id})"><i class="fas fa-plus"></i>Sale</i>
                                </td>
                            </tr>`
                    });

                    $("#table_1").html(html);
                }

            });

        }

        function deli_pay(val){
            // alert(val);
            $.ajax({

                type:'POST',

                url:'/searchDelicharges',

                data:{
                    "_token":"{{csrf_token()}}",
                    "town_id":val,
                },

                success:function(data){
                    // alert(data.status);
                    if(data.status == 0){
                        swal({
                            title:"Don't Allow Delivery",
                            text:"This town is not allowed delivery!",
                            icon:"info",
                        });
                    }
                    else{
                        $('#deli_charges').val(data.delivery_charges);
                    }
                }
            })
        }

        function searchByCuisineTwo(value){

            $('#table_2').empty();

            $.ajax({

                type:'POST',

                url:'/searchByCuisine',

                data:{
                    "_token":"{{csrf_token()}}",
                    "cuisine_id":value,
                },

                success:function(data){

                    var html = "";

                    $.each(data,function(i, v){

                        var id = v.id;

                        var item = v.item_name;

                        var photo_path =  '{{asset('/photo/Item/')}}'+ "/" + v.photo_path;

                        html+=`<tr>
                                <td>${item}</td>
                                <td>
                                    <img src="${photo_path}" class="img-rounded" width="100" height="70" />
                                </td>
                                <td class="text-center">
                                    <i class="btn btn-success" onclick="getCountingUnit(${id})"><i class="fas fa-plus"></i>Sale</i>
                                </td>
                            </tr>`
                    });

                    $("#table_2").html(html);
                }

            });

        }

        function searchByCuisineThree(value){

            $('#table_3').empty();

            $.ajax({

                type:'POST',

                url:'/searchByCuisine',

                data:{
                    "_token":"{{csrf_token()}}",
                    "cuisine_id":value,
                },

                success:function(data){

                    var html = "";

                    $.each(data,function(i, v){

                        var id = v.id;

                        var item = v.item_name;

                        var photo_path =  '{{asset('/photo/Item/')}}'+ "/" + v.photo_path;

                        html+=`<tr>
                                <td>${item}</td>
                                <td>
                                    <img src="${photo_path}" class="img-rounded" width="100" height="70" />
                                </td>
                                <td class="text-center">
                                    <i class="btn btn-success" onclick="getCountingUnit(${id})"><i class="fas fa-plus"></i>Sale</i>
                                </td>
                            </tr>`
                    });

                    $("#table_3").html(html);
                }

            });
        }

        function getCountingUnit(item_id){
            console.log(item_id)
            var html = "";

            $.ajax({

                type:'POST',

                url:'getCountingUnitsByItemId/',


                data:{
                    "_token":"{{csrf_token()}}",
                    "item_id":item_id,
                },
                success:function(data){

                    $.each(data, function(i, unit) {
                        if(unit.brake_flag ==2){
                            html+=`<tr class="text-center">
                            <input type="hidden" id="item_name" value="${unit.menu_item.item_name}">
                            <input type="hidden" id="price_${unit.id}" value="${unit.sale_price}">
                            <td>${unit.menu_item.item_name}</td>
                            <td id="name_${unit.id}">${unit.name}</td>
                            <td>${unit.sale_price}</td>
                            <td><i class="btn btn-danger">Brake</i></td>
                            </tr>

                        `;
                        }
                        else{
                            html+=`<tr class="text-center">
                            <input type="hidden" id="item_name" value="${unit.menu_item.item_name}">
                            <input type="hidden" id="price_${unit.id}" value="${unit.sale_price}">
                            <td>${unit.menu_item.item_name}</td>
                            <td id="name_${unit.id}">${unit.name}</td>
                            <td>${unit.sale_price}</td>
                            <td><i class="btn btn-primary" onclick="tgPanel(${unit.id})"><i class="fas fa-plus"></i>Add</i></td>
                            </tr>

                        `;
                        }
                    });

                    $("#count_unit").html(html);

                    $("#unit_table_modal").modal('show');
                }

            });
        }

        function tgPanel(id){

            // alert(id);

            var item_name = $('#item_name').val();
            console.log(item_name);

            var item_price_check = $('#price_' + id).val();

            var name = $('#name_' + id).text();

            var qty_check = $('#qty_' + id).val();

            var qty = parseInt(qty_check);

            var price = parseInt(item_price_check);

            if( item_price_check == ""){

                Swal.fire({
                    title:"Please Check",
                    text:"Please Select Price To Sell",
                    icon:"info",
                });
            }
            else{

// swal("Please Enter Quantity:", {
//     content: "input",
// })

// .then((value) => {
//     if(value.toString().match(/^\d+$/)){
//     if (value > qty ) {

//         swal({
//             title:"Can't Add",
//             text:"Your Input is higher than Current Quantity!",
//             icon:"info",
//         });

//     }else{

                // alert('hello!');

                $('.note_class').hide();


                var total_price = price * 1 ;

                var item={id:id,item_name:item_name,unit_name:name,current_qty:qty,order_qty:1,selling_price:price};
                console.log(item);
                var total_amount = {sub_total:total_price,total_qty:1};

                var mycart = localStorage.getItem('mycart');

                var grand_total = localStorage.getItem('grandTotal');

                //console.log(item);

                if(mycart == null ){

                    mycart = '[]';

                    var mycartobj = JSON.parse(mycart);

                    mycartobj.push(item);

                    localStorage.setItem('mycart',JSON.stringify(mycartobj));

                }else{

                    var mycartobj = JSON.parse(mycart);

                    var hasid = false;

                    $.each(mycartobj,function(i,v){

                        if(v.id == id ){

                            hasid = true;

                            v.order_qty = parseInt(1) + parseInt(v.order_qty);
                        }
                    })

                    if(!hasid){

                        mycartobj.push(item);
                    }

                    localStorage.setItem('mycart',JSON.stringify(mycartobj));
                }

                if(grand_total == null ){

                    localStorage.setItem('grandTotal',JSON.stringify(total_amount));

                }else{

                    var grand_total_obj = JSON.parse(grand_total);

                    grand_total_obj.sub_total = total_price + grand_total_obj.sub_total;

                    grand_total_obj.total_qty = parseInt(1) + parseInt(grand_total_obj.total_qty);

                    localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));
                }

                $("#unit_table_modal").modal('hide');

                showmodal();

            }
//     }else{
//         swal({
//             title:"Input Invalid",
//             text:"Please only input english digit",
//             icon:"info",
//         });
//     }
// })

// }
        }

        function showmodal(){

            var mycart = localStorage.getItem('mycart');
            console.log(mycart);
            var grandTotal = localStorage.getItem('grandTotal');

            var grandTotal_obj = JSON.parse(grandTotal);

            if(mycart){

                var mycartobj = JSON.parse(mycart);

                var html='';

                if(mycartobj.length>0){

                    $.each(mycartobj,function(i,v){

                        var id=v.id;

                        var item=v.item_name;

                        var qty=v.order_qty;

                        var count_name = v.unit_name

                        html+=`<tr>
                            <td class="text-success font-weight-bold">${item}</td>

                            <td class="text-success font-weight-bold">${count_name}</td>

                            <td>
                                <i class="fa fa-plus-circle btnplus" onclick="plus(${id})" id="${id}"></i>
                                ${qty}
                                <i class="fa fa-minus-circle btnminus"  onclick="minus(${id})" id="${id}"></i>
                            </td>

                            <td class="text-success font-weight-bold">${v.selling_price}</td>
                            <td class="text-success font-weight-bold"><button class="btn btn-sm btn-info" id="note_${id}" onclick="note(${id})">Note</button></td>
                            </tr>
                            <tr>
                                <th class="text-danger font-weight-bold">Notes:</th>
                                <td class="text-danger font-weight-bold" colspan="4" id="note_remark_${id}"></td>
                            </tr>
                            `;


                    });
                }

                $("#total_quantity").text(grandTotal_obj.total_qty);

                $("#sub_total").text(grandTotal_obj.sub_total);

                $("#sale").html(html);
            }
        }

        function plus(id){





            count_change(id,'plus',1);


        }

        function minus(id){



            count_change(id,'minus',1);


        }

        function count_change(id,action,qty){

            var grand_total = localStorage.getItem('grandTotal');

            var mycart=localStorage.getItem('mycart');

            var mycartobj=JSON.parse(mycart);

            var grand_total_obj = JSON.parse(grand_total);

            var item = mycartobj.filter(item =>item.id == id);

            if( action == 'plus'){

                if (item[0].order_qty == item[0].current_qty) {

                    swal({
                        title:"Can't Add",
                        text:"Can't Added Anymore!",
                        icon:"info",
                    });

                    $('#btn_plus_' + item[0].id).attr('disabled', 'disabled');
                }
                item[0].order_qty++;

                grand_total_obj.sub_total += parseInt(item[0].selling_price);

                grand_total_obj.total_qty ++;

                localStorage.setItem('mycart',JSON.stringify(mycartobj));

                localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));



                showmodal();
            }
            else if (action == 'minus') {
                console.log(item[0].order_qty);
                if(item[0].order_qty == 1){

                    var ans=confirm('Are you sure');

                    if(ans){

                        let item_cart = mycartobj.filter(item =>item.id !== id );

                        grand_total_obj.sub_total -= parseInt(item[0].selling_price);

                        grand_total_obj.total_qty -- ;

                        localStorage.setItem('mycart',JSON.stringify(item_cart));

                        localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));

                        showmodal();

                    }else{

                        item[0].order_qty;

                        localStorage.setItem('mycart',JSON.stringify(mycartobj));

                        localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));

                        showmodal();
                    }

                }else{

                    item[0].order_qty--;

                    grand_total_obj.sub_total -= parseInt(item[0].selling_price);

                    grand_total_obj.total_qty -- ;

                    localStorage.setItem('mycart',JSON.stringify(mycartobj));

                    localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));

                    // count_item();

                    showmodal();
                }
            }
        }

        // function showCheckOut(){
        //     if($('.custom-control-input').prop('checked')){
        //         // alert('success');
        //         var take_away = 1;
        //     }else{
        //         var take_away = 0;
        //     }
        //     var mycart = localStorage.getItem('mycart');
        //
        //     var myremark = localStorage.getItem('myremark');
        //
        //     if(!mycart){
        //
        //         swal({
        //             title:"Please Check",
        //             text:"Menu Item Cannot be Empty to Check Out",
        //             icon:"info",
        //         });
        //
        //     }else{
        //         $("#t_away").attr('value', take_away);
        //
        //         $("#item").attr('value', mycart);
        //
        //         $('#cus_complain').attr('value',myremark);
        //
        //
        //         $("#vourcher_page").submit()
        //
        //         // localStorage.clear();
        //
        //     }
        // }

        function AddMoreItem(order){
            if($('.custom-control-input').prop('checked')){
                // alert('success');
                var take_away = 1;
            }else{
                var take_away = 0;
            }

            var mycart = localStorage.getItem('mycart');

            var myremark = localStorage.getItem('myremark');

            if(!mycart){

                swal({
                    title:"Please Check",
                    text:"Menu Item Cannot be Empty to Check Out",
                    icon:"info",
                });

            }else{
                $('#add_complain').attr('value',myremark);

                $("#option_lists").attr('value', mycart);

                $("#order_id").attr('value', order);

                $("#t_add_away").attr('value', take_away);

                $("#add_more_item").submit();

                localStorage.clear();

            }

        }
        function DeliAddMoreItem(order){

            var mycart = localStorage.getItem('mycart');

            var myremark = localStorage.getItem('myremark');

            if(!mycart){

                swal({
                    title:"Please Check",
                    text:"Menu Item Cannot be Empty to Check Out",
                    icon:"info",
                });

            }else{

                $("#deli_option_lists").attr('value', mycart);

                $('#add_deli_complain').attr('value',myremark);

                $("#deli_order_id").attr('value', order);

                $("#deli_add_more_item").submit();

                localStorage.clear();

            }

        }

        $( document ).ready(function() {
            $('#name').val('');
            $('#phone').val('');
            $('#address').val('');
            $('#order_date').val('');
            $('#note').val('');
        });

        function fill_remark(){
            var text = ($("#select2 option:selected").text());
            $('#complain').val(text);
        }

        function note(id){
            $('#remark_table_modal').modal('show');
            $('#note_id').val(id);

            $('.note_class').show();
            // $('#select2').text('Select_code');

        }
        function  save_note(){
            // alert('hello');
            var note_id = $('#note_id').val();
            var complain = $('#complain').val();
            // alert(complain);
            $('#remark_table_modal').modal('hide');

            $('#note_remark_'+note_id).text(complain);
            var note = {id:note_id,remark:complain};
            var myremark = localStorage.getItem('myremark');
            console.log(note);
            if(myremark == null ){

                myremark = '[]';

                var myremarkobj = JSON.parse(myremark);

                myremarkobj.push(note);

                localStorage.setItem('myremark',JSON.stringify(myremarkobj));

            }else{
                var myremarkobj = JSON.parse(myremark);

                myremarkobj.push(note);

                localStorage.setItem('myremark',JSON.stringify(myremarkobj));
            }
            // $('#select2').empty();
            // $('#select2').clear();
            // $('#select2').text('Select Code');
            $('#select2').val(null).trigger('change');

        }


    </script>

@endsection
