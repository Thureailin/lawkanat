@extends('master')

@section('title','Purchase History')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Purchase History</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Purchase History</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold">Purchase History</h2>
    </div>

    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <a href="{{route('create_purchase')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>                   
                Create Purchase
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="card-title">Purchase History</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Purchase Date</th>
                            <th>Total Quantity</th>
                            <th>Total Price</th>
                            <th>Purchase By</th>
                            <th>Supplier Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($purchase_lists as $list)
                            <tr>
                                <th>{{$i++}}</th>
                                <th>{{date('d-m-Y', strtotime($list->purchase_date))}}</th>
                                <th>{{$list->total_quantity}}</th>
                                <th>{{$list->total_price}}</th>                                
                                <th>{{$list->user->name}}</th>
                                <th>{{$list->supplier_name}}</th>
                                <th class="text-center">
                                    <a href="{{route('purchase_details',$list->id)}}" class="btn btn-primary">
                                        <i class="fas fa-check"></i>                   
                                        Check Details
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection