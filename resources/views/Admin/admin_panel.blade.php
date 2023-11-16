@extends('master')

@section('title','Admin Panel')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Admin Panel</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Dashborad</a></li>
        <li class="breadcrumb-item active">Admin Panel</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold">Admin Panel</h2>
    </div>
</div>



<div class="row">    
    
    <div class="col-lg-5 col-md-5">
        <a href="{{route('employee_list')}}">
            <div class="card card-success">
	            <div class="card-body">
	            	<div class="row justify-content-center">
	            		<img src="{{asset('image/icons8-user-group-100.png')}}">
	            	</div>	                
	                	

	                <h4 class="text-center text-dark font-weight-bold mt-3">Employees</h4>
	            		
	            </div>
	        </div>               
        </a>        
    </div>

    @if(session()->get('user')->role_flag == 4)
    <div class="col-lg-5 col-md-5">
        <a href="{{route('table_list')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/icons8-restaurant-table-100.png')}}">
                    </div>                  
                        

                    <h4 class="text-center text-dark font-weight-bold mt-3">Table List</h4>
                        
                </div>
            </div>               
        </a>        
    </div>
    @endif
</div>

@endsection