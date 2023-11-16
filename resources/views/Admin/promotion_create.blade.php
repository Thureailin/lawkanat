@extends('master')

@section('title','Expenses List')

@section('place')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Promotion List</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Promotion List</li>
    </ol>
</div>

@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Promotion List</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Promotion List</h4>
                <div class="table-responsive">
                    <table class="table" id="example23">
                        <thead>
                            <tr>
                                <th>Promotion Title</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($promotion as $item)
                           <tr>
                                <td>{{$item->title}}</td>
                                @if($item->reward == 1)
                                <td>Cash Back</td>
                                @elseif($item->reward == 2)
                                <td>FOC Items</td>
                                @else
                                <td>Discount</td>
                                @endif

                                <td>{{$item->start_date}}</td>
                                <td>{{$item->end_date}}</td>
                                <td class="text-center" style="text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_item{{$item->id}}">
                                        <i class="mdi mdi-wrench"></i>
                                    </a>
                                    <a href="{{route('promotion.delete',$item->id)}}" class="btn btn-danger deletemenu">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#detail_item{{$item->id}}">
                                        <i class="mdi mdi-reorder-horizontal"></i>
                                    </a>
                                </td>

                                {{-- <div class="modal fade" id="edit_item{{$item->id}}" role="dialog" aria-hidden="true">
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
                                </div> --}}
                                <div class="modal fade" id="detail_item{{$item->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Promotion Detail</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Promotion Title</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->title}}</h5>
                                                    </div>
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Type</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    @if ($item->reward == 1)
                                                    <div class="col-4">
                                                        <h5>Cash Back</h5>
                                                    </div>
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Cash Back Amount</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->amount}}</h5>
                                                    </div>
                                                    @elseif($item->reward == 2)
                                                    <div class="col-4">
                                                        <h5>FOC Items</h5>
                                                    </div>
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">FOC Items</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->foc_items}}</h5>
                                                    </div>
                                                    @else
                                                    <div class="col-4">
                                                    <h5>Discount</h5>
                                                    </div>
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Discount Percentage</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->percent}} %</h5>
                                                    </div>
                                                    @endif
                                                    @if ($item->type == 1)
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Voucher Amount</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-4">
                                                        <h5>{{$item->voucher_amount}}</h5>
                                                    </div>
                                                    @elseif ($item->type == 2)
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Purchase Item</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->purchase_item}} </h5>
                                                    </div>
                                                    @else
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Purchase Time</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->purchase_time}}</h5>
                                                    </div>
                                                    @endif
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">Start Date</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->start_date}}</h5>
                                                    </div>
                                                    <div class="offset-1 col-5">
                                                        <h5 class="font-weight-bold">End Date</h5>
                                                    </div>
                                                    <div class="col-1 font-weight-bold">
                                                        :
                                                    </div>
                                                    <div class="col-5">
                                                        <h5>{{$item->end_date}}</h5>
                                                    </div>
                                                </div>
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
                <h3 class="card-title">Promotion Create Form</h3>
                <form class="form-material m-t-40" method="post" action="{{route('promotion_store')}}" enctype='multipart/form-data'>
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter promotion title" required>

                        @error('title')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Choose Type</label>
                        <div class="row">
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="radio" name="flexRadio1" id="m_amount" value="1" onclick="amount_max()">
                                <label class="form-check-label" for="m_amount">
                                  Voucher Amount
                                </label>
                            </div>
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="radio" name="flexRadio1" id="m_qty" value="2" onclick="qty_max()">
                                <label class="form-check-label" for="m_qty">
                                  Purchase Items
                                </label>
                            </div>
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="radio" name="flexRadio1" id="m_time" value="3" onclick="time_max()">
                                <label class="form-check-label" for="m_time">
                                 Purcahse Time
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="max_amount1">
                        <label class="font-weight-bold">Voucher Amount</label>
                        <input type="text" name="voucher_amount" class="form-control" placeholder="Enter Voucher Amount">
                    </div>
                    <div class="form-group" id="max_qty1">
                        <label class="font-weight-bold">Purchase Items</label>
                        <select class="form-control" name="purchaseitem[]"  id="select22" multiple="multiple">
                            <option value="" disabled>Select Menu Items</option>
                            @foreach ($menu as $m)
                            <option value="{{$m->item_name}}">{{$m->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="max_time1">
                        <label class="font-weight-bold">Purchase Time</label>
                        <input type="text" name="purchase_time" class="form-control" placeholder="Enter Purchase Time">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Rewards</label>
                        <div class="row">
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="cash" value="1" onclick="cash_radio()">
                                <label class="form-check-label" for="cash">
                                  Cash Back
                                </label>
                            </div>
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="f_item" value="2" onclick="item_radio()">
                                <label class="form-check-label" for="f_item">
                                  FOC Item
                                </label>
                            </div>
                            <div class="col-md-4 form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="discount" value="3" onclick="discount_radio()">
                                <label class="form-check-label" for="discount">
                                  Discount
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="form-group" id="p_amount">
                        <label class="font-weight-bold">Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter promotion amount">
                    </div>

                    <div class="form-group" id="p_percentage">
                        <label class="font-weight-bold">Percentage</label>
                        <input type="text" name="percentage" class="form-control" placeholder="Enter promotion percentage">
                    </div>

                    <div class="form-group" id="p_menu">
                        <label class="font-weight-bold">Menu Items</label>
                        <select class="form-control" name="menuitem[]"  id="select2" multiple="multiple">
                            <option value="" disabled>Select Menu Items</option>
                            @foreach ($menu as $mu)
                            <option value="{{$mu->item_name}}">{{$mu->item_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Promotion Period</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                         <label class="control-label">Customer Console</label>
                            <div class="switch">
                                <label>OFF
                                    <input type="checkbox" checked name="customer_console"><span class="lever"></span>ON</label>
                            </div>
                    </div>

                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save Promotion">
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')


<script type="text/javascript">

    $(document).ready(function() {
        $('#select2').select2();
        $('#select22').select2();

        $('#p_amount').hide();
        $('#p_percentage').hide();
        $('#p_menu').hide();
        $('#max_amount1').hide();
        $('#max_qty1').hide();
        $('#max_time1').hide();
    })

    function cash_radio(){
        $('#p_amount').show();
        $('#p_percentage').hide();
        $('#p_menu').hide();
    }

    function item_radio(){
        $('#p_menu').show();
        $('#p_amount').hide();
        $('#p_percentage').hide();
    }

    function discount_radio(){
        $('#p_percentage').show();
        $('#p_amount').hide();
        $('#p_menu').hide();
    }

    function amount_max(){
        $('#max_amount1').show();
        $('#max_qty1').hide();
        $('#max_time1').hide();
    }
    function qty_max(){
        $('#max_amount1').hide();
        $('#max_qty1').show();
        $('#max_time1').hide();
    }
    function time_max(){
        $('#max_amount1').hide();
        $('#max_qty1').hide();
        $('#max_time1').show();
    }


</script>

@endsection
