@extends('master')

@section('title','Order Details')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Order Details</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Order Details</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold">Order Details Page</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="font-weight-bold mt-2">Order Details</h4>
            </div>
            <div class="card-body">
            	@if($order->status == 1)
            	<h4 class="font-weight-bold mt-2 text-center">
            		<span class="badge badge-info font-weight-bold">Incoming Order</span>
            	</h4>
            	@elseif($order->status == 2)
            	<h4 class="font-weight-bold mt-2 text-center">
            		<span class="badge badge-info font-weight-bold">Confirm Order</span>
            	</h4>
            	@elseif($order->status == 3)
            	<h4 class="font-weight-bold mt-2 text-center">
            		<span class="badge badge-info font-weight-bold">Delivered Order</span>
            	</h4>	
            	@elseif($order->status == 4)
            	<h4 class="font-weight-bold mt-2 text-center">
            		<span class="badge badge-info font-weight-bold">Accepted Order</span>
            	</h4>            	
            	@endif


            	<div class="row">
            		<div class="col-md-4">

            			<div class="row">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Order Number  </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->order_number}}</h5>
				        </div> 

            			<div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Order Date  </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{date('d-m-Y', strtotime($order->order_date))}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Order Address</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->address}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Order Total Quantity</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->total_quantity}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Order EST Price</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->price}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Customer Name</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->name}}</h5>
				        </div> 			   

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Customer Phone </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->phone}}</h5>
				        </div>

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1">Customer Note </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->note}}</h5>
				        </div>

				        @if($order->status == 3)
				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1" style="overflow:hidden;white-space: nowrap;">Delivered Date & Time </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{date('d-m-Y h:i A' , strtotime($order->delivered_date))}}
			              	</h5>
				        </div>

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1" style="overflow:hidden;white-space: nowrap;">Delivery Person </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->employee->name}}
			              	</h5>
				        </div>

            			@endif

				        @if($order->status == 4)
				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1" style="overflow:hidden;white-space: nowrap;">Accepted Date & Time </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{date('d-m-Y h:i A' , strtotime($order->accepted_date))}}
			              	</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-6 offset-md-1" style="overflow:hidden;white-space: nowrap;">Delivery Person </div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$order->employee->name}}
			              	</h5>
				        </div>                  
            			@endif
            		</div>

            		<div class="col-md-8">
            			<h4 class="font-weight-bold mt-2 text-primary text-center">Order Unit's List</h4>
            			<div class="table-responsive">
		                    <table class="table" id="example23">
		                        <thead>
		                            <tr>
		                                <th>Menu Item Name</th>
		                                <th>Option Name & Size</th>
		                                <th>Order Quantity</th>
										<th>Price</th>
										<th>Sub Total Price</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            @foreach($order->option as $option)

		                            <tr>
	                                	<td>{{$option->menu_item->item_name}}</td>
	                                	<td>{{$option->name}}</td>
	                                	<td>{{$option->pivot->quantity}}</td>
										<td>{{$option->sale_price}}</td>
										<td><?= $option->sale_price * $option->pivot->quantity?></td>		                                   
	                                </tr>   


		                         
		                                                                
		                            @endforeach
		                        </tbody>
		                    </table>
		                </div>
            		</div>

            	</div>                
            </div>
        </div>
    </div>
</div>

@endsection