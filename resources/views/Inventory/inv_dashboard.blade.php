@extends('master')

@section('title','Inventory Dashboard')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Inventory Dashboard</li>
    </ol>
</div>

@endsection


@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h2 class="font-weight-bold">Inventory Dashboard</h2>
    </div>
</div>


<div class="row justify-content-center">

    <div class="col-lg-4 col-md-4">
        <a href="{{route('meal_list')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/92801377_877091472805605_68878940281765888_n.png')}}">
                    </div>
                    <h4 class="text-center text-dark font-weight-bold mt-3">Meal List</h4>

                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-4">
        <a href="{{route('cuisine_type_list')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/93544808_221607162457745_5859617280568066048_n.png')}}">
                    </div>


                    <h4 class="text-center text-dark font-weight-bold mt-3">Cuisine Type List</h4>

                </div>
            </div>
        </a>
    </div>
</div>

<div class="row justify-content-center">

    <div class="col-lg-4 col-md-4">
        <a href="{{route('menu_item_list')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/93544808_221607162457745_5859617280568066048_n.png')}}">
                    </div>


                    <h4 class="text-center text-dark font-weight-bold mt-3">Menu Item List</h4>

                </div>
            </div>
        </a>
    </div>

    {{-- <div class="col-lg-4 col-md-4">
        <a href="{{route('ingredient_list')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/93544808_221607162457745_5859617280568066048_n.png')}}">
                    </div>


                    <h4 class="text-center text-dark font-weight-bold mt-3">Ingredient List</h4>

                </div>
            </div>
        </a>
    </div> --}}
</div>

<div class="row justify-content-center">

    {{-- <div class="col-lg-4 col-md-4">
        <a href="{{route('reorder_list')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/93544808_221607162457745_5859617280568066048_n.png')}}">
                    </div>


                    <h4 class="text-center text-dark font-weight-bold mt-3">Reorder List</h4>

                </div>
            </div>
        </a>
    </div> --}}

    {{-- <div class="col-lg-4 col-md-4">
        <a href="{{route('stock_update')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/93544808_221607162457745_5859617280568066048_n.png')}}">
                    </div>


                    <h4 class="text-center text-dark font-weight-bold mt-3">Stock Count Update</h4>

                </div>
            </div>
        </a>
    </div> --}}
</div>

@endsection
