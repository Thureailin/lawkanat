
@extends('master')

@section('title','Order Page')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Order Page</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Order Page</li>
    </ol>
</div>

@endsection

@section('content')

<style>
    th{
    overflow:hidden;
    white-space: nowrap;
  }
</style>

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold text-info">Order Page</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                @if($type == 1)
                <h4 class="font-weight-bold mt-2">Incoming Order List</h4>
                @elseif($type == 2)
                <h4 class="font-weight-bold mt-2">Confirm Order List</h4>
                @elseif($type == 3)
                <h4 class="font-weight-bold mt-2">Delivered Order List</h4>
                @elseif($type == 4)
                <h4 class="font-weight-bold mt-2">Accepted Order List</h4>                
                @endif

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="example23">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer's Name</th>
                                <th>Order Address</th>
                                <th>Order Date & Time</th>
                                 @if($type == 3)
                                <th>Delivered Date & Time</th>
                                @endif
                                @if($type == 4)
                                <th>Accepted Date&Time</th>
                                @endif
                                <th>Order Total Qty</th>
                                <th>Order Status</th>
                                <th class="text-center">Details</th>
                                @if($type != 4)
                                <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_lists as $order)
                                <tr>
                                    
                                	<td>{{$order->order_number}}</td>
                                    <td>{{$order->name}}</td>
                                	<td style="overflow:hidden;white-space: nowrap;">{{$order->address}}</td>
                                	
                                    <td style="overflow:hidden;white-space: nowrap;">{{date('d-m-Y h:i A', strtotime($order->order_date))}}</td>
                                   
                                    @if($order->status ==  3)
                                    <td style="overflow:hidden;white-space: nowrap;">{{date('d-m-Y h:i A' , strtotime($order->delivered_date))}}</td>
                                    @endif
                                    @if($order->status == 4)
                                    <td style="overflow:hidden;white-space: nowrap;">{{date('d-m-Y h:i A' , strtotime($order->accepted_date))}}</td>
                                    @endif
                                	<td>{{$order->total_quantity}}</td>

                                    @if($order->status == 1)
                                	<td><span class="badge badge-info font-weight-bold">Incoming Order</span></td>
                                    @elseif($order->status == 2)
                                    <td><span class="badge badge-info font-weight-bold">Confirm Order</span></td>
                                    @elseif($order->status == 3)
                                    <td><span class="badge badge-info font-weight-bold">Delivered Order</span></td>
                                    @elseif($order->status == 4)
                                    <td><span class="badge badge-info font-weight-bold">Accepted Order</span></td>
                                    @endif
                                	<td class="text-center"><a href="{{route('order_details', $order->id)}}" class="btn btn-info">Check Details</a>
                                    </td>

                                    @if($type == 1)

                                    <td class="text-center">
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#confirm_{{$order->id}}">Confirm Order</a>
                                    </td>

                                    @elseif($type == 2)

                                    <td class="text-center">
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#confirm_{{$order->id}}">Delivered Order</a>
                                    </td>

                                    @elseif($type ==3)

                                    <td class="text-center">
                                       Order is Delivered
                                    </td>

                                    @else

                                    <td class="text-center">
                                       Order is Accepted
                                    </td>

                                    @endif

                                    <div class="modal fade" id="confirm_{{$order->id}}" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Chang Order Status Form</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form class="form" method="post" action="{{route('update_order_status')}}">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                                        <input type="hidden" name="order_status" value="{{$order->status}}">

                                                        @if($order->status == 2)

                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-5 col-form-label">
                                                                Delivered Date & Time
                                                            </label>

                                                            <div class="col-7">
                                                                <input class="form-control" type="datetime-local" name="delivered_date" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-5 col-form-label">
                                                                Choose Employee
                                                            </label>

                                                            <div class="col-7">
                                                                <select class="form-control" name="employee" style="width: 100%"  required>
                                                                    <option value="">Select Employee</option>
                                                                    @foreach($employee_lists as $emp)
                                                                      
                                                                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                                                                       
                                                                    @endforeach                              
                                                                </select>
                                                            </div>
                                                        </div>                                                            
                                                        @endif

                                                        <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Change Order Status">
                                                    </form>           
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </tr>                                   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

<script type="text/javascript">
    $(document).ready(function(){
        localStorage.clear();
    })
    $('#example23').DataTable( {
    
        "paging":   false,
        "ordering": true,
        "info":     false

    });

</script>



@endsection