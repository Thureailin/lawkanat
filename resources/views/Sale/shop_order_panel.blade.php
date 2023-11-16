@extends('master')

@section('title','Shop Order Panel')

@section('place')


<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Shop Order Panel</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Dashborad</a></li>
        <li class="breadcrumb-item active">Shop Order Panel</li>
    </ol>
</div>


@endsection

@section('content')


<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Shop Order Panel</h2>
    </div>
</div>



<div class="row">

    <div class="col-lg-5 col-md-5">
        <a href="{{route('sale_page')}}">
            <div class="card card-success">
	            <div class="card-body">
	            	<div class="row justify-content-center">
	            		<img src="{{asset('image/icons8-list-100.png')}}">
	            	</div>


	                <h4 class="text-center text-dark font-weight-bold mt-3">Shop Order</h4>

	            </div>
	        </div>
        </a>
    </div>

    <div class="col-lg-5 col-md-5">
        <a href="{{route('pending_lists')}}">
            <div class="card card-success">
	            <div class="card-body">
	            	<div class="row justify-content-center">
	            		<img src="{{asset('image/icons8-check-file-100.png')}}">
	            	</div>


	                <h4 class="text-center text-dark font-weight-bold mt-3">Pending Shop Order List</h4>

	            </div>
	        </div>
        </a>
    </div>


    <div class="col-lg-5 col-md-5">
        <a href="{{route('finished_lists')}}">
            <div class="card card-success">
	            <div class="card-body">
	            	<div class="row justify-content-center">
	            		<img src="{{asset('image/icons8-purchase-order-100.png')}}">
	            	</div>

	                <h4 class="text-center text-dark font-weight-bold mt-3">Shop Order Voucher List</h4>

	            </div>
	        </div>
        </a>
    </div>

    <div class="col-lg-5 col-md-5">
        <a href="{{route('delivery_pending_lists')}}">
            <div class="card card-success">
	            <div class="card-body">
	            	<div class="row justify-content-center">
	            		<img src="{{asset('image/icons8-check-file-100.png')}}">
	            	</div>


	                <h4 class="text-center text-dark font-weight-bold mt-3">Pending Delivery Order List</h4>

	            </div>
	        </div>
        </a>
    </div>

</div>

@endsection
