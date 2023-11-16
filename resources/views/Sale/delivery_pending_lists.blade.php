@extends('master')

@section('title','Delivery Order Pending Page')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Pending Delivery Order Page</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Pending Delivery Order Page</li>
    </ol>
</div>

@endsection

@section('content')
<?php $user = session()->get('user')->role_flag;?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="font-weight-bold mt-2">Pending Delivery Order List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="example23">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Address</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pending_lists as $order)
                                <tr>
                                	<td>{{$order->order_number}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>
                                    	<a href="{{route('deli_pending_order_details', $order->id)}}" class="btn btn-info">Check Order Details</a>

                                    	{{-- <a href="{{route('deli_add_more_item', $order->id)}}" class="btn btn-success">Add More Item</a> --}}

                                        @if($user == 3)
                                    	    {{-- <button class="btn" style="background-color:lightgreen;color:white;" onclick="done({{$order->table_id}})">Done</button> --}}
                                            {{-- <button class="btn btn-danger" style="color:white;" onclick="cancel({{$order->id}})">Cancel</button> --}}
                                            <a href="{{route('cancelorder', $order->id)}}" class="btn btn-danger">Cancel</a>
                                    	@else
                                    	    <button class="btn btn-primary" onclick="storeVoucher({{$order->id}})">Store Voucher</button>
                                    	@endif
                                        {{-- <button class="btn btn-primary" onclick="storeVoucher({{$order->id}})">Store Voucher</button> --}}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="voudiscount" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Item Price</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    id="#close_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="checkout_modal_body">
                <input type="hidden" id="vou_discount" name="vou_discount">
                <input type="hidden" id="hid_order_id">
                <input type="hidden" id="dis_type">
                <input type="hidden" id="dis_val">
                <div class="form-group">
                    <label class="font-weight-bold">Voucher Total</label>
                    <input type="text" class="form-control" readonly id="voucher_total" value="">
                </div>
                <div class="row text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio_foc" onclick="foc_radio()">
                        <label class="form-check-label" for="radio_foc">
                          FOC
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio_percent" onclick="percent_radio()">
                        <label class="form-check-label" for="radio_percent">
                          Discount Percent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio_amount" onclick="amount_radio()">
                        <label class="form-check-label" for="radio_amount">
                          Discount Amount
                        </label>
                    </div>
                </div>
                <div class="form-group mt-3" id="dis_foc">
                    <label class="font-weight-bold">FOC</label>
                    <input type="text" class="form-control"  value="0">
                </div>
                <div class="form-group mt-3" id="dis_percent">
                    <label class="font-weight-bold">Discount Percent</label>
                    <input type="text" class="form-control"  value="" placeholder="Enter percent (%)" onkeyup="percent_dis(this.value)">
                </div>
                <div class="form-group mt-3" id="dis_amount">
                    <label class="font-weight-bold">Discount Amount</label>
                    <input type="text" class="form-control amount_dis"  value="" placeholder="Enter Amount" onkeyup="amount_dis(this.value)">
                </div>
                <div class="form-group mt-3">
                    <label class="font-weight-bold">Current Voucher Total</label>
                    <input type="text" class="form-control" readonly id="curr_voucher_total" value="">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Delivery Charges</label>
                    <input type="text" class="form-control" readonly id="dis_deli_charges" value="">
                </div>
                <div class="form-group mt-3">
                    <label class="font-weight-bold">Pay Amount</label>
                    <input type="text" class="form-control"  value="" id="pay_amount" placeholder="Enter Pay Amount" onkeyup="pay_amt(this.value)">
                </div>
                <div class="form-group mt-3">
                    <label class="font-weight-bold">Change</label>
                    <input type="text" class="form-control" readonly id="change_amount" value="">
                </div>
                <button type="button" class="btn btn-success mt-4" onclick="change_price()" btn-lg
                    btn-block">Store Voucher</button>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="dis_radio_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Store Voucher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-4 mb-2">
                    <h4 class="font-weight-bold">Discount:</h4>
                </div>
                <div class="col-md-4 form-check">
                    <input class="form-check-input" type="radio" name="flexRadio" id="radio_yes" onclick="yes_radio()">
                    <label class="form-check-label" for="radio_yes">
                      YES
                    </label>
                </div>
                <div class="col-md-4 form-check">
                    <input class="form-check-input" type="radio" name="flexRadio" id="radio_no" onclick="no_radio()">
                    <label class="form-check-label" for="radio_no">
                      NO
                    </label>
                </div>
            </div>
            <div class="form-group" id="dis_voucher_total">
                <label class="font-weight-bold">Voucher Total</label>
                <input type="text" class="form-control" readonly id="voucher_total_dis" value="">
            </div>
            <div class="form-group" id="delivery_charges">
                <label class="font-weight-bold">Delivery Charges</label>
                <input type="text" class="form-control" readonly id="deli_charges" value="">
            </div>
            <div class="form-group mt-3" id="dis_pay_amount">
                <label class="font-weight-bold">Pay Amount</label>
                <input type="text" class="form-control"  value="" id="pay_amount_dis" placeholder="Enter Pay Amount" onkeyup="pay_dis(this.value)">
            </div>
            <div class="form-group mt-3" id="dis_change_amount">
                <label class="font-weight-bold">Change</label>
                <input type="text" class="form-control" readonly id="change_amount_dis" value="">
            </div>
        </div>
        <div class="modal-footer" id="dis_footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="change_price()">Store Voucher</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')

<script>

 $(document).ready(function() {
    $('#dis_foc').hide();
    $('#dis_percent').hide();
    $('#dis_amount').hide();
})
function yes_radio(){
    // alert('yes');
    $('#dis_radio_form').modal('hide');
    $('#voudiscount').modal('show');
}
function no_radio(){
    // alert('no');
    $('#dis_voucher_total').show();
    $('#delivery_charges').show();
    $('#dis_pay_amount').show();
    $('#dis_change_amount').show();
    $('#dis_footer').show();
}
function foc_radio(){
    $('#dis_foc').show();
    $('#dis_percent').hide();
    $('#dis_amount').hide();
    var dis_value = $('#curr_voucher_total').val(0);
    $('#dis_type').val(1);
    $('#dis_val').val(0);
}
function percent_radio(){
    $('#dis_foc').hide();
    $('#dis_percent').show();
    $('#dis_amount').hide();
    $('#dis_type').val(2);
}
function amount_radio(){
    $('#dis_foc').hide();
    $('#dis_percent').hide();
    $('#dis_amount').show();
    $('#dis_type').val(3);
}
function percent_dis(val){
    // alert(val);
    var v_total = $('#voucher_total').val();
    // alert(v_total);
    var per_amt = v_total - (val/100)*v_total;
    $('#curr_voucher_total').val(per_amt);
    $('#dis_val').val(val);
}
function amount_dis(val){
    // alert(val);
    var v_total = $('#voucher_total').val();
    var per_amt = v_total-val;
    $('#curr_voucher_total').val(per_amt);
    $('#dis_val').val(val);
}
function pay_amt(val){
    // alert(val);
    var curr_amt = $('#curr_voucher_total').val();
    var deli = $('#dis_deli_charges').val();
    $('#change_amount').val(val - curr_amt - deli);
}
function pay_dis(val){
    // alert(val);
    var curr_amt = $('#voucher_total_dis').val();
    var deli = $('#deli_charges').val();
    $('#change_amount_dis').val(val - curr_amt - deli);
}
function change_price(){
    // $('#voudiscount').modal('hide');
    var order_id = $('#hid_order_id').val();
    var discount_type = $('#dis_type').val();
    var discount_value = $('#dis_val').val();
    var pay_value = $('#pay_amount').val();
    var change_value = $('#change_amount').val();
    var pay_value_dis = $('#pay_amount_dis').val();
    var change_value_dis = $('#change_amount_dis').val()

     $.ajax({

        type:'POST',

        url:'/DeliveryVoucherStore',

        data:{
        "_token":"{{csrf_token()}}",
        "order_id":order_id,
        "discount_type" : discount_type ,
        "discount_value" : discount_value,
        "pay_amount" : pay_value,
        "change_amount" : change_value,
        "pay_amount_dis" : pay_value_dis,
        "change_amount_dis" : change_value_dis,
        },

        success:function(data){
            // alert(data);
            if(data.error){
                swal({
                title: "Failed!",
                text : "Something Wrong!",
                icon : "error",
            });
            }
            else{


            swal({
                title: "Success!",
                text : "Successfully Stored!",
                icon : "success",
            });

            var url = '{{ route("delivery_order_voucher", ":order_id") }}';

            url = url.replace(':order_id', data.id);

            setTimeout(function(){

                window.location.href= url;

            }, 1000);
            }
        }

        });

}


    function storeVoucher(order_id){
        //
        $.ajax({

            type:'POST',

            url:'/DeliveryDiscountForm',

            data:{
            "_token":"{{csrf_token()}}",
            "order_id":order_id,
            },

            success:function(data){
                // $('#voudiscount').modal('show');
                $('#hid_order_id').val(order_id);
                $('#dis_type').val();
                $('#dis_val').val();
                $('#voucher_total_dis').val(data.total);
                $('#deli_charges').val(data.order.delivery_charges);
                $('#voucher_total').val(data.total);
                $('#dis_deli_charges').val(data.order.delivery_charges);
            }
        })
        $('#dis_radio_form').modal('show');
        $('#dis_voucher_total').hide();
        $('#delivery_charges').hide();
        $('#dis_pay_amount').hide();
        $('#dis_change_amount').hide();
        $('#dis_footer').hide();
        //

    }

   

</script>


@endsection
