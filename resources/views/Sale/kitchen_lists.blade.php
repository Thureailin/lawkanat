@extends('master')

@section('title','Kitchen List Details')

@section('place')

{{-- <div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Kitchen Options</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Shop Order Voucher</li>
    </ol>
</div> --}}

@endsection

@section('content')

<style>

    td{
        text-align:left;
        font-size:15px;
    }

    th{
        text-align:left;
        font-size:15px;
    }

    h6{
        font-size:15px;
        font-weight:500;
    }
</style>
<?php $wname = session()->get('user')->name;?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-5 printableArea" style="width:45%;">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <address>
                                    <h4 class="font-weight-bold"> &nbsp;<b class="text-center">Law Ka Nat&nbsp;&nbsp;(<span class="text-danger">Kitchen</span>)</b></h4>
                                        <h5 class="font-weight-bold">Restaurant</h5>
                                </address>
                            </div>

                            <div class="pull-right text-left">
                                <h5 class="font-weight-bold">Waiter Name : {{$wname}}</h5>
                                    <h5 class="font-weight-bold">Date : <i class="fa fa-calendar"></i> {{$real_date}} </h5>
                                    @if($tablenoo != 1)
                                       @if ($take_away == 1)
                                       <h5 class="font-weight-bold">Table-Number : {{$tableno->table_number}}  (Take Away)</h5>
                                       @else
                                       <h5 class="font-weight-bold">Table-Number : {{$tableno->table_number}}</h5>
                                       @endif


                                    @elseif($tablenoo == 1)
                                    <h5 class="font-weight-bold">Table-Number : Delivery Order</h5>
                                    @endif
                                </font>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td class="font-weight-bold">Kitchen</td>
                                            <td class="font-weight-bold">Menu Name</td>
                                            <td class="font-weight-bold">Option & Size</td>
                                            <td class="font-weight-bold">Qty</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($fromadd == 0)
                                    @foreach($name as $opname)
                                   @foreach($option_name as $optqty)
                                   @if($optqty->tocook == 0)

                                    @if($opname->id == $optqty->option_id)
                                    @if ($opname->menu_item->cuisine_type_id == 1)
                                    <tr>
                                        <td class="font-weight-bold">(Salad)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 2)

                                    <tr>
                                        <td class="font-weight-bold">(Breakfast)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 3)

                                    <tr>
                                        <td class="font-weight-bold">(Healthy Food)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 4)

                                    <tr>
                                        <td class="font-weight-bold">(Main)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 5)

                                    <tr>
                                        <td class="font-weight-bold">(Snacks)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @endif
                                   </tbody>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach
                                   @endif

                                   @if($fromadd == 1)
                                    @foreach($name as $opname)
                                   @foreach($option_name as $optqty)

                                    @if($optqty->tocook == 1)
                                    @if($opname->id == $optqty->option_id)
                                    @if ($opname->menu_item->cuisine_type_id == 1)
                                    <tr>
                                        <td class="font-weight-bold">(Salad)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 2)

                                    <tr>
                                        <td class="font-weight-bold">(Breakfast)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 3)

                                    <tr>
                                        <td class="font-weight-bold">(Healthy Food)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 4)

                                    <tr>
                                        <td class="font-weight-bold">(Main)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 5)

                                    <tr>
                                        <td class="font-weight-bold">(Snacks)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach
                                   @endif

                                   @if($fromadd == 3)
                                   @foreach($name as $opname)
                                   @foreach($option_name as $optqty)
                                   {{-- @if($optqty->tocook == 0) --}}

                                    @if($opname->id == $optqty->option_id)
                                    @if ($opname->menu_item->cuisine_type_id == 1)
                                    <tr>
                                        <td class="font-weight-bold">(Salad)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 2)

                                    <tr>
                                        <td class="font-weight-bold">(Breakfast)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 3)

                                    <tr>
                                        <td class="font-weight-bold">(Healthy Food)</td>
                                        <td class="font-weight-bold"> {{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 4)

                                    <tr>
                                        <td class="font-weight-bold">(Main)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @elseif ($opname->menu_item->cuisine_type_id == 5)

                                    <tr>
                                        <td class="font-weight-bold">(Snacks)</td>
                                        <td class="font-weight-bold">{{$opname->name}}</td>
                                        <td class="font-weight-bold">{{$opname->menu_item->item_name}}</td>
                                        <td class="font-weight-bold">{{$optqty->quantity -$optqty->old_quantity}}</td>
                                        {{-- <td>{{$optqty->note}}</td> --}}
                                    </tr>
                                    @foreach ($notte as $notes)
                                        @if ($notes->option_id == $opname->id)
                                            <tr>
                                            <th class="text-danger font-weight-bold">Notes</th>
                                            <td class="text-danger" colspan="3">{{$notes->note}}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @endif
                                   </tbody>
                                    @endif
                                    {{-- @endif --}}
                                    @endforeach
                                    @endforeach
                                   @endif
                                </table>


                                <h5 class="text-center font-weight-bold">***************</h5>
                        </div>
                    </div>

                </div>
             </div>

            </div>

            <div class="col-md-12">
                <div class="text-center">
                    <button id="print" class="btn btn-info" type="button">
                        <span><i class="fa fa-print"></i> Print</span>

                    </button>
                    @if ($tablenoo == 1)
                    <a href="{{route('delivery_pending_lists')}}" id="goto" class="btn btn-outline-danger" type="button">
                        <span><i class="fa fa-info"></i> To Pending Voucher Lists </span>

                    </a>
                    @else
                    <a href="{{route('gotopendinglist')}}" id="goto" class="btn btn-outline-danger" type="button">
                        <span><i class="fa fa-info"></i> To Pending Voucher Lists </span>

                    </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{asset('js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>

<script>
    $(document).ready(function() {
        $("#print").click(function() {
            // window.print();
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });

    </script>


@endsection
