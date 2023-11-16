@extends('master')

@section('title','Dashboard')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
</div>

@endsection

@section('content')

<div class="row">

    <div class="col-lg-4 col-md-4">
        <a href="{{route('report')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/icons8-admin-settings-male-100.png')}}">
                    </div>
                    <h4 class="text-center text-dark font-weight-bold mt-3">Admin Dashboard</h4>

                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-4">
        <a href="{{route('inven_dashboard')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/icons8-warehouse-100.png')}}">
                    </div>
                    <h4 class="text-center text-dark font-weight-bold mt-3">Inventory</h4>

                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-4">
        <a href="{{route('admin_dashboard')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/icons8-admin-settings-male-100.png')}}">
                    </div>
                    <h4 class="text-center text-dark font-weight-bold mt-3">Admin</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-4">
        <a href="{{route('order_panel')}}">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('image/icons8-list-100.png')}}">
                    </div>
                    <h4 class="text-center text-dark font-weight-bold mt-3">Delivery Order</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-4">
        <a href="{{route('shop_order_panel')}}">
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
</div>

@endsection
