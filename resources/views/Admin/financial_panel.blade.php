@extends('master')

@section('title','Financial Report')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Financial</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back_to_dashboard</a></li>
        <li class="breadcrumb-item active">Financial</li>
    </ol>
</div>

@endsection

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            	<h4 class="card-title text-success">Financial list</h4>
                <div class="row">
                {{--<div class="col-md-8">
                    <ul class="nav nav-pills m-t-30 m-b-30">
                        <li class=" nav-item">
                            <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">daily</a>
                        </li>
                        <li class="nav-item">
                            <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">weekly</a>
                        </li>
                        <li class="nav-item">
                            <a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="false">monthly</a>
                        </li>
                    </ul>

                </div> --}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <select class="form-control custom-select shopOrdelivery">--}}
{{--                            <option value="1">Shop</option>--}}
{{--                            <option value="2">Delivery</option>--}}
{{--                            <option value="3">Total</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
               </div>

               <div class="row form-group">
               <div class="col-md-3">
                   <label for="">Choose Type</label>

                   <select class="form-control custom-select shopOrdelivery">
                       <option value="1">Shop</option>
                       <option value="2">Delivery</option>
                       <option value="3">Total</option>
                   </select>
               </div>
                <div class=" col-md-3">
                    <label for="">Start Date</label>
                    <input type="date" class="form-control" id="start_date">
                </div>
                <div class="col-md-3">
                    <label for="">End Date</label>
                    <input type="date" class="form-control" id="end_date">
                </div>
                <div class="col-md-3" >
                    <button style="margin-top: 32px;" class="btn btn-m btn-primary" onclick="showDateFilterSale()">Search</button>
                </div>
            </div>

                <br/>
{{--                Daily, Weekly , Monthly Search--}}
{{--                <div class="tab-content br-n pn">--}}
{{--                    <div id="navpills-1" class="tab-pane active">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                     <label class="control-label text-success font-weight-bold">Daily</label>--}}
{{--                                    <input type="date" class="form-control" id="daily">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3 pull-right">--}}
{{--                                <button class="btn btn-success btn-submit" type="submit" onclick="showDailySale()">--}}
{{--                                	Search--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div id="navpills-2" class="tab-pane">--}}
{{--                    	<div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label text-success font-weight-bold">weekly</label>--}}
{{--                                    <select class="form-control custom-select" id="weekly">--}}
{{--                                        <option value="">select week</option>--}}
{{--                                        <option value="1">one week</option>--}}
{{--                                        <option value="2">two week</option>--}}
{{--                                        <option value="3">three week</option>--}}
{{--                                        <option value="4">four week</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3 pull-right">--}}
{{--                                <button class="btn btn-success btn-submit" type="submit" onclick="showWeeklySale()">--}}
{{--                                	Search--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div id="navpills-3" class="tab-pane">--}}
{{--                    	<div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label text-success font-weight-bold">monthly</label>--}}
{{--                                    <select class="form-control custom-select" id="monthly">--}}
{{--                                        <option value="">select month</option>--}}
{{--                                        <option value="01">January</option>--}}
{{--                                        <option value="02">February</option>--}}
{{--                                        <option value="03">March</option>--}}
{{--                                        <option value="04">April</option>--}}
{{--                                        <option value="05">May</option>--}}
{{--                                        <option value="06">June</option>--}}
{{--                                        <option value="07">July</option>--}}
{{--                                        <option value="08">August</option>--}}
{{--                                        <option value="09">September</option>--}}
{{--                                        <option value="10">October</option>--}}
{{--                                        <option value="11">November</option>--}}
{{--                                        <option value="12">December</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3 pull-right">--}}
{{--                                <button class="btn btn-success btn-submit" type="submit" onclick="showMonthlySale()">--}}
{{--                                	Search--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="card mt-3" id="report">
        	<div class="card-body">
        		<div class="row mt-2 allShopAndDeliZero">
	                <div class="col-md-4">
	                    <h4 class="text-success font-weight-bold">
	                    	Total Sales -
	                    	<span class="badge badge-pill badge-success" id="total_sales"></span>
	                    </h4>
	                </div>
                    <div class="col-md-4">
	                    <h4 class="text-success font-weight-bold">
	                    	Total Expenses -
	                    	<span class="badge badge-pill badge-success" id="total_expense"></span>
	                    </h4>
	                </div>

	                <div class="col-md-4">
	                    <h4 class="text-success font-weight-bold">
	                    	Total Profit -
	                    	<span class="badge badge-pill badge-success" id="profit"></span>
	                    </h4>
	                </div>
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <ul class="nav nav-pills m-t-30 m-b-30">--}}
{{--                                <li class=" nav-item">--}}
{{--                                    <a href="#nav-pills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Sales</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#nav-pills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Expenses</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="tab-content br-n pn">--}}
{{--                        <div id="nav-pills-1" class="tab-pane active">--}}
{{--                            <div class="row">--}}
{{--                                <h3>Hello</h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}



	                <div class="col-md-12 mt-3">
	                    <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-capitalize text-center font-weight-bold text-success">
                                    	voucher number
                                    </th>
                                    <th class="text-capitalize text-center font-weight-bold text-success">
                                    	total amount
                                    </th>
                                    <th class="text-capitalize text-center font-weight-bold text-success">
                                    	total quantity
                                    </th>
                                    <th class="text-capitalize text-center font-weight-bold text-success">
                                    	Table No.
                                    </th>
                                    <th class="text-capitalize text-center font-weight-bold text-success">
                                    	date
                                    </th>
                                    <th class="text-capitalize text-center font-weight-bold text-success">
                                    	action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="sale_table">

                            </tbody>
                        </table>
	                </div>
                </div>

                <div class="allShopAndDeliOne py-5 text-dark" style="font-weight: 500;">
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Shop total sale</div>
                        <div class="col-md-4"><span id="shop_total_sale"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Delivery total sale</div>
                        <div class="col-md-4"><span id="delivery_total_sale"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="col-md-5 offset-md-3">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center ">Shop Gross Profit</div>
                        <div class="col-md-4"><span id="shop_gross_profit"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Delivery Gross Profit</div>
                        <div class="col-md-4"><span id="delivery_gross_profit"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Total Gross Profit</div>
                        <div class="col-md-4"><span id="total_gross_profit"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="col-md-5 offset-md-3">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Fixed Expenses</div>
                        <div class="col-md-4"><span id="fixed_expenses"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Variable Expenses</div>
                        <div class="col-md-4"><span id="variable_expenses"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Total Expenses</div>
                        <div class="col-md-4"><span id="total_expenses"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                    <div class="col-md-5 offset-md-3">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-3 text-center">Total Net Profit</div>
                        <div class="col-md-4"><span id="total_net_profit"></span> <span class="text-success">MMK</span>  </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>

	$(document).ready(function() {

	    $('#report').hide();

	});

    function finicialRecord(data){

        console.log(data);
        var tot_sale = 0;
        if(data.allShopAndDeli==0){
            // $('#total_sales').text(data.total_sales);
            $('#total_expense').text(data.expenses_indate_amount);

            // $('#profit').text(data.total_profit);

            $.each(data.voucher_lists,function(i,value){
                let url = "{{url('/Order-Voucher/')}}/"+value.id;

                let button = `<a href="${url}" class="btn btn-success">Details</a>`
                if(value.shop_order==null){
                    var tableNumber = 'Not Found';
                }
                else{
                    var tableNumber = value.shop_order.table.table_number;
                }

                if(value.discount_type == 3){
                    $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price-value.discount_value)).append($('<td>').text(value.total_quantity)).append($('<td>').text(tableNumber)).append($('<td>').text(value.date)).append($('<td>').append($(button)));
                        tot_sale += value.total_price-value.discount_value;
                }
                else if(value.discount_type == 2){
                    $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price-(value.total_price/100)*value.discount_value)).append($('<td>').text(value.total_quantity)).append($('<td>').text(tableNumber)).append($('<td>').text(value.date)).append($('<td>').append($(button)));
                        tot_sale += value.total_price-(value.total_price/100)*value.discount_value;
                }
                else if(value.discount_type == 2){
                    $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(0)).append($('<td>').text(value.total_quantity)).append($('<td>').text(tableNumber)).append($('<td>').text(value.date)).append($('<td>').append($(button)));

                }
                else{
                    $('#sale_table').append($('<tr>')).append($('<td>').text(value.voucher_code)).append($('<td>').text(value.total_price)).append($('<td>').text(value.total_quantity)).append($('<td>').text(tableNumber)).append($('<td>').text(value.date)).append($('<td>').append($(button)));
                        tot_sale += value.total_price;
                }


            });
            if(data.voucher_lists.length==0){
                $('#sale_table').append($('<tr>')).append($('<td>').text('No Found'));
            }
            // new total sale
            $('#total_sales').text(tot_sale);
            $('#profit').text(tot_sale-data.expenses_indate_amount);

            
            $('#report').show();
            $('.allShopAndDeliZero').show();

            $('.allShopAndDeliOne').hide();
        }
        else if (data.allShopAndDeli==1){
            console.log(data);

            $('#shop_total_sale').text(data.shop_total_sale);
            $('#delivery_total_sale').text(data.delivery_total_sale);
            var shop_gross_profit= data.shop_total_sale - data.shop_total_est_price;
            var delivery_gross_profit= data.delivery_total_sale - data.delivery_total_est_price;
            $('#shop_gross_profit').text(shop_gross_profit);
            $('#delivery_gross_profit').text(delivery_gross_profit);
            var total_gross_profit = shop_gross_profit + delivery_gross_profit;
            $('#total_gross_profit').text(total_gross_profit);
            $('#fixed_expenses').text(data.total_fixed_expense);
            $('#variable_expenses').text(data.expenses_indate_amount);
            var total_expenses = data.total_fixed_expense + data.expenses_indate_amount;
            $('#total_expenses').text(total_expenses);
            var total_net_profit = total_gross_profit - total_expenses;
            $('#total_net_profit').text(total_net_profit);

            $('#report').show();

            $('.allShopAndDeliZero').hide();

            $('.allShopAndDeliOne').show();
        }
            }

	function showDailySale() {
		$('#total_sales').empty();
		$('#total_expense').empty();
		$('#sale_table').empty();
		let  daily = $('#daily').val();
        let shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();
		let  type  = 1;
		$.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "value": daily,
            "type": type,
            "shopOrdelivery" : shopOrdelivery,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){
                finicialRecord(data);

            }
        });
	}

    // Date Filter
    function showDateFilterSale() {

        $('#total_sales').empty();

        $('#sale_table').empty();

        var  start_date = $('#start_date').val();
        var  end_date = $('#end_date').val();

        var shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();

        var  type  = 7;

        $.ajax({
        type:'POST',
        url:'/getTotalSaleReport',
        data:{
            "start_date" : start_date,
            "end_date" : end_date,
            "type": type,
            "shopOrdelivery" : shopOrdelivery,
            "_token":"{{csrf_token()}}"
        },

            success:function(data){
                finicialRecord(data);
            }
        });
        }

	function showWeeklySale() {


		$('#total_sales').empty();

		$('#total_sales').empty();

		$('#sale_table').empty();

		var  daily = $('#weekly').val();

        var shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();

		var  type  = 2;

		$.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "value": daily,
            "type": type,
            "shopOrdelivery": shopOrdelivery,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

                finicialRecord(data);

            }
        });
	}

	function showMonthlySale() {
		$('#total_sales').empty();

		$('#total_sales').empty();

		$('#sale_table').empty();

		var  daily = $('#monthly').val();

		var  type  = 3;

        var shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();

		$.ajax({
           type:'POST',
           url:'/getTotalSaleReport',
           data:{
            "value": daily,
            "type": type,
            "shopOrdelivery" : shopOrdelivery,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

            	finicialRecord(data);

            }
        });

	}

</script>

@endsection
