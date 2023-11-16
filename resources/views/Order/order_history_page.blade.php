@extends('master')

@section('title','Sale History Page')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Order Voucher History Page</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Sale History Page</li>
    </ol>
</div>

@endsection

@section('content')

<section id="plan-features">

    <div class="row mb-4 justify-content-center">
        <form action="{{route('search_order_history')}}" method="POST" class="form">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <label class="control-label font-weight-bold">From</label>
                    <input type="date" name="from" class="form-control" required>
                </div>
                
                <div class="col-md-5">
                    <label class="font-weight-bold">To</label>
                    <input type="date" name="to" class="form-control" required>
                </div>

                <div class="col-md-2 m-t-30">
                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Search">
                </div>
            </div>
        </form>
    </div>
            
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="slimtest2">
                            <table class="table" id="item_table">
                                <thead>
                        <tr>
                            <th class="font-weight-bold text-themecolor">#</th>
                            <th class="font-weight-bold text-themecolor">Voucher Number</th>
                            <th class="font-weight-bold text-themecolor">Voucher Date</th>
                            <th class="font-weight-bold text-themecolor">Sold By</th>
                            <th class="font-weight-bold text-themecolor">Total Quantity</th>
                            <th class="font-weight-bold text-themecolor">Total Price</th>
                            <th class="font-weight-bold text-themecolor">Details</th>
                        </tr>
                    </thead>
                    <tbody id="item_list">
                        <?php
                            $i = 1;
                        ?>
                       @foreach($voucher_lists as $voucher) 
                        <tr>
                            <td class="font-weight-bold">{{$i++}}</td>
                            <td class="font-weight-bold">{{$voucher->voucher_code}}</td>
                            <td class="font-weight-bold">{{$voucher->voucher_date}}</td>
                            <td class="font-weight-bold">{{$voucher->user->name}}</td>
                            <td class="font-weight-bold">{{$voucher->total_quantity}}</td>
                            <td class="font-weight-bold">{{$voucher->total_price}}</td>
                            <td style="text-align: center;"><a href="{{ route('getVoucherDetails',$voucher->id)}}" class="btn btn-primary" style="color: white;">Details</a></td>
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
</section>

@endsection

@section('js')

<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

<script type="text/javascript">

	$('#item_table').DataTable( {

            "paging":   false,
            "ordering": true,
            "info":     false

    });
        
    $('#slimtest2').slimScroll({
        color: '#00f',
        height: '600px'
    });
	
</script>

@endsection