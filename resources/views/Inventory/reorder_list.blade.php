@extends('master')

@section('title','Reorder List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Reorder List</li>
    </ol>
</div>

@endsection

@section('content')

<style>

    th {
        overflow:hidden;
        white-space: nowrap;
    }

</style>

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold text-info">Reorder List</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-info">Reorder List</h4>
                <div class="table-responsive">
                    <table class="table" id="example23">
                        <thead>
                            <tr>
                                <th class="text-info">Ingredient Name</th>
                                <th class="text-info">Purchase Price</th>
                                <th class="text-info">Unit</th>
                                <th class="text-info">Reorder Qty</th>
                                <th class="text-info">Instock Qty</th>
                                <th class="text-info">Brand Name</th>
                                <th class="text-info">Supplier Name</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($reorder as $reodr)
                        @if($reodr->instock_quantity < $reodr->reorder_quantity)
                            <tr>
                                <td>{{$reodr->name}}</td>
                                <td>{{$reodr->purchase_price}}</td>
                                <td>{{$reodr->unit}}</td>
                                <td>{{$reodr->reorder_quantity}}</td>
                                <td>{{$reodr->instock_quantity}}</td>
                                <td>{{$reodr->brand_name}}</td>
                                
                                <td>{{$reodr->supplier_name}}</td>
                            </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
