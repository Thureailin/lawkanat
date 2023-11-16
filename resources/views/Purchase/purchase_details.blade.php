@extends('master')

@section('title','Purchase Details')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Purchase Details</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Purchase Details</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold">Purchase Details</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="font-weight-bold mt-2">Purchase Details</h4>
            </div>
            <div class="card-body">
           	           	
            	<div class="row">
            		<div class="col-md-6">

            			<div class="row">				           
			              	<div class="font-weight-bold text-primary col-md-5">Purchase Date</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">
			              		{{date('d-m-Y', strtotime($purchase->purchase_date))}}
			              	</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-5">Total Price</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$purchase->total_price}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-5">Total Quantity</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$purchase->total_quantity}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-5">Supplier Name</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$purchase->supplier_name}}</h5>
				        </div> 

				        <div class="row mt-1">				           
			              	<div class="font-weight-bold text-primary col-md-5">Purchase By</div>
			              	<h5 class="font-weight-bold col-md-4 mt-1">{{$purchase->user->name}}</h5>
				        </div>

            		</div>

            		<div class="col-md-6">
            			<h4 class="font-weight-bold mt-2 text-primary text-center">Ingredient Lists</h4>
            			<div class="table-responsive">
		                    <table class="table" id="example23">
		                        <thead>
		                            <tr>
		                                <th>Ingredient Name</th>
		                                <th>Purchase Quantity</th>
		                                <th>Purchase Price</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            @foreach($purchase->ingredient as $ingredient)
		                                <tr>
		                                	<td>{{$ingredient->name}}</td>
		                                	<td>{{$ingredient->pivot->quantity}}</td>			                                   
		                                	<td>{{$ingredient->pivot->price}}</td>			                                   
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