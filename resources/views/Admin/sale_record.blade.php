@extends('master')

@section('title','Sale Records')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Sale Records</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to dashboard</a></li>
        <li class="breadcrumb-item active">Sale Records</li>
    </ol>
</div>

@endsection

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            	<h4 class="card-title text-success">Sale Records</h4>
               <div class="row">
                <div class="col-md-8">
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
    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control custom-select shopOrdelivery">
                            <option value="1">Shop</option>
                            <option value="2">Delivery</option>
                        </select>
                    </div>
                </div>    
               </div>
                        
            
                
                <br/>
                <div class="tab-content br-n pn">
                    <div id="navpills-1" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label class="control-label text-success font-weight-bold">daily</label>
                                    <input type="date" class="form-control" id="daily">
                                </div>
                            </div>

                            <div class="col-md-3 pull-right">
                                <button class="btn btn-success btn-submit" type="submit" onclick="showDailySale()">	
                                	Search
                                </button>
                            </div>
                        </div> 
                    </div>

                    <div id="navpills-2" class="tab-pane">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-success font-weight-bold">weekly</label>
                                    <select class="form-control custom-select" id="weekly">
                                        <option value="">select week</option>
                                        <option value="1">one week</option>
                                        <option value="2">two week</option>
                                        <option value="3">three week</option>
                                        <option value="4">four week</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 pull-right">
                                <button class="btn btn-success btn-submit" type="submit" onclick="showWeeklySale()">	
                                	Search
                                </button>
                            </div>
                        </div>                        
                    </div>

                    <div id="navpills-3" class="tab-pane">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-success font-weight-bold">monthly</label>
                                    <select class="form-control custom-select" id="monthly">
                                        <option value="">select month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 pull-right">
                                <button class="btn btn-success btn-submit" type="submit" onclick="showMonthlySale()">	
                                	Search
                                </button>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3" id="report">
        	<div class="card-body">
        		
                <div class=" py-5 text-dark" style="font-weight: 500;">
                    <div class="row text-success sale_count_header">
                        <div class="col-md-3 offset-md-2 text-center">Item Name</div>
                        <div class="col-md-2">
                        <p>Option Name</p>
                        </div>
                        <div class="col-md-2">
                            <p>Qty</p>
                        </div>
                        <div class="col-md-2">
                            <p>Subtotal</p>
                        </div>
                    </div>
                    <div class="row salecountlists">
                      
                    </div>
                    <div class="row text-center sale_count_footer">
                        <div class="col-md-2 offset-md-6">
                            <p class="text-success">Total Qty:  <span id="total_qty" class="text-dark" style="font-weight:bold"></span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-success">Total : <span id="total_price" class="text-dark" style="font-weight:bold"></span></p>
                        </div>
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

    function saleRecord (data){
        console.log(data);
                    var html= "";
                    var total=0;
                    var total_qty=0;
                    console.log(data.total_qty.length);
                    $.each(data.options,function(i,v){
                        $.each(data.menu_items,function(j,val){
                            $.each(data.total_qty,function(k,value){
                                if(v.id== value.option_id && v.menu_item_id==val.id){
                                  
                                    var subtotal= value.qty * v.sale_price;
                                    html+=`
                                    <div class="col-md-3 offset-md-2 text-center">${val.item_name}</div>
                                        <div class="col-md-2">
                                        <p>${v.name}</p>
                                        </div>
                                        <div class="col-md-2">
                                            <p>${value.qty}</p>
                                    </div>
                                    <div class="col-md-2">
                                            <p>${subtotal}</p>
                                    </div>
                                    `;
                                    total+=subtotal;
                                    total_qty+=value.qty;
                                }
                            })
                        })
                    })
                    $('.salecountlists').html(html);
                    $('#total_qty').html(total_qty);
                    $('#total_price').html(total);
                    var html2="";
                    if(data.total_qty.length==0){
                        html2= `
                        <div class="col-md-12 text-center">
                            <p class=" text-danger">No Sale Records Found !</p>
                        </div>
                        `;
                    $('.salecountlists').html(html2);
                    
                    $('.sale_count_header').hide();
                    $('.sale_count_footer').hide();
                    }
                    $('#report').show();
    }
	function showDailySale() {

		var  daily = $('#daily').val();

        var shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();

		var  type  = 1;

		$.ajax({
           type:'POST',
           url:'/get-sale-record',
           data:{   
            "value": daily,
            "type": type,
            "shopOrdelivery" : shopOrdelivery,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){
                
            saleRecord(data);

            }
        });
	}

	function showWeeklySale() {

		var  daily = $('#weekly').val();

        var shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();

		var  type  = 2;

		$.ajax({
           type:'POST',
           url:'/get-sale-record',
           data:{   
            "value": daily,
            "type": type,
            "shopOrdelivery": shopOrdelivery,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

                saleRecord(data);
               
            }
        });		
	}

	function showMonthlySale() {
		var  daily = $('#monthly').val();

		var  type  = 3;

        var shopOrdelivery= $( ".shopOrdelivery option:selected" ).val();

		$.ajax({
           type:'POST',
           url:'/get-sale-record',
           data:{   
            "value": daily,
            "type": type,
            "shopOrdelivery" : shopOrdelivery,
            "_token":"{{csrf_token()}}"
           },

           	success:function(data){

                saleRecord(data);                  
            }
        });
		
	}
	
</script>

@endsection