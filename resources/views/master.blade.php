<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">

    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/plugins/c3-master/c3.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">

    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/plugins/dropify/dist/css/dropify.min.css')}}">

    <link rel="stylesheet" href="{{asset('js/dist/css/qrcode-reader.min.css')}}">

    <link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

</head>

<body class="fix-header fix-sidebar card-no-border logo-center">


    @include('sweet::alert')

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                            <img src="{{asset('image/lawkanat.png')}}" alt="" width="40px" height="40px">
                            <h2 class="text-white font-weight-bold font-italic ml-2">လောကနတ်</h2>
                            <input type="hidden" id="unique_role" value="{{session()->get('user')->role_flag}}">
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center" id="noti">
                                            <!-- Message -->
                                            {{-- <a href="{{route('pending_lists')}}">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pending Shop Order List<span class="badge badge-danger float-right" id="stockNoti"></span></h5>
                                                    <small>Check Orders</small>
                                                </div>
                                            </a> --}}

                                            {{-- <a href="{{route('delivery_pending_lists')}}">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pending Delivery Order List<span class="badge badge-danger float-right" id="stockNoti"></span></h5>
                                                    <small>Check Orders</small>
                                                </div>
                                            </a> --}}

                                            {{-- <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Reorder<span class="badge badge-danger float-right" id="stockNoti"></span></h5>
                                                    <small>Check Reorder Item</small>
                                                </div>
                                            </a> --}}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('image/user.jpg')}}" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{asset('image/user.jpg')}}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{session()->get('user')->name}}</h4>
                                                <p class="text-muted">{{session()->get('user')->email}}</p>
                                                <a href="#" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{route('change_password_ui')}}"><i class="mdi mdi-account-key"></i> Change Password </a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{route('logoutprocess')}}"><i class="mdi mdi-power"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="{{ url()->previous() }}" class="nav-link waves-effect waves-dark pt-2"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">

            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @if(session()->get('user')->role_flag == 1)
                        <li>
                            <a href="{{route('index')}}">
                                <i class="mdi mdi-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        @endif
                        @if(session()->get('user')->role_flag == 1 || session()->get('user')->role_flag == 5)
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <i class="mdi mdi-store"></i>
                                <span class="hide-menu">
                                    Inventory
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">

                                <li><a href="{{route('inven_dashboard')}}">Inventory Dashboard</a></li>
                                <li><a href="{{route('meal_list')}}">Meal List</a></li>
                                <li><a href="{{route('cuisine_type_list')}}">Cuisine Type List</a></li>
                                <li><a href="{{route('menu_item_list')}}">Menu Item List</a></li>
                                {{-- <li><a href="{{route('ingredient_list')}}">Ingredient List</a></li> --}}
                                <li><a href="{{route('customer_complain_list')}}">Code List</a></li>
                                {{-- <li><a href="{{route('reorder_list')}}">Reorder List</a></li> --}}
                                {{-- <li><a href="{{route('stock_update')}}">Stock Count Update</a></li> --}}

                            </ul>
                        </li>
                        @endif
                        {{-- <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <i class="mdi mdi-clipboard-text"></i>
                                <span class="hide-menu">
                                    Delivery Order
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('order_panel')}}">Delivery Order Panel</a></li>
                                <li><a href="{{route('order_page','1')}}">Incoming Order</a></li>
                                <li><a href="{{route('order_page','2')}}">Confirm Order</a></li>
                                <li><a href="{{route('order_page','3')}}">Delivered Order</a></li>
                                <li><a href="{{route('order_page','4')}}">Accepted Order</a></li>
                                <!-- <li><a href="{{route('order_history')}}">Order Voucher History</a></li>    -->
                            </ul>
                        </li> --}}
                        @if(session()->get('user')->role_flag == 1 || session()->get('user')->role_flag == 2  || session()->get('user')->role_flag == 3 || session()->get('user')->role_flag == 4)
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <i class="mdi mdi-clipboard-text"></i>
                                <span class="hide-menu">
                                    Shop Order
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('shop_order_panel')}}">Shop Order Panel</a></li>
                                <li><a href="{{route('sale_page')}}">Shop Order</a></li>
                                <li><a href="{{route('pending_lists')}}">Pending Shop Order List</a></li>
                                <li><a href="{{route('delivery_pending_lists')}}">Pending Delivery Order List</a></li>
                                <li><a href="{{route('finished_lists')}}">Order Voucher List</a></li>
                            </ul>
                        </li>
                        @endif

                        @if(session()->get('user')->role_flag == 1)
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <i class="mdi mdi-account-multiple-outline"></i>
                                <span class="hide-menu">
                                    Admin
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('admin_dashboard')}}">Admin Panel</a></li>
                                {{-- <li><a href="{{route('purchase_list')}}">Purchase History</a></li> --}}
                                <li><a href="{{route('employee_list')}}">Employee List</a></li>
                                <li><a href="{{route('table_list')}}">Manage Table List</a></li>
                                <li><a href="{{route('state_list')}}">State And Township List</a></li>
                                <li><a href="{{route('getfinicial')}}">Financial</a></li>
                                <li><a href="{{route('expense')}}">Purchase Expense List</a></li>
                                <li><a href="{{route('sale_record')}}">Sale Count</a></li>
                                <li><a href="{{route('promotion_create')}}">Promotion List</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(session()->get('user')->role_flag == 6)
                         <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <i class="mdi mdi-account-multiple-outline"></i>
                                <span class="hide-menu">
                                    Financial
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('purchase_list')}}">Purchase History</a></li>
                                <li><a href="{{route('getfinicial')}}">Financial</a></li>
                                <li><a href="{{route('expense')}}">Purchase Expense List</a></li>
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('logoutprocess')}}"><i class="mdi mdi-power"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>

        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="noti" style="position: fixed">
                </div>

                <div class="row page-titles">

                    @yield('place')

                    <!--<div class="col-md-7 col-4 align-self-center">-->
                    <!--    <div class="d-flex m-t-10 justify-content-end">-->
                    <!--        <div class="d-flex m-r-20 m-l-10 hidden-md-down">-->
                    <!--            <div class="chart-text m-r-10">-->
                    <!--                <h6 class="m-b-0"><small>Today Sale</small></h6>-->
                    <!--                <h4 class="m-t-0 text-info">{{number_format(session()->get('today_sale')) }} MMK</h4></div>-->
                    <!--            <div class="spark-chart">-->
                    <!--                <div id="monthchart"></div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="d-flex m-r-20 m-l-10 hidden-md-down">-->
                    <!--            <div class="chart-text m-r-10">-->
                    <!--                <h6 class="m-b-0"><small>Yesterday Sale</small></h6>-->
                    <!--                <h4 class="m-t-0 text-primary">{{number_format(session()->get('last_day_sale')) }} MMK</h4></div>-->
                    <!--            <div class="spark-chart">-->
                    <!--                <div id="lastmonthchart"></div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>

                @yield('content')

            </div>
            <div id="mobileprint" class="d-none">

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            {{-- <footer class="footer"> © 2018 Material Pro Admin by wrappixel.com </footer> --}}
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>

    <!--c3 JavaScript -->
    <script src="{{asset('assets/plugins/d3/d3.min.js')}}"></script>

    <script src="{{asset('assets/plugins/c3-master/c3.min.js')}}"></script>

    <script src="{{asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>

    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>

    <script src="{{asset('assets/plugins/multiselect/js/jquery.multi-select.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('js/validation.js')}}"></script>

    <script src="{{ asset('js/dist/js/qrcode-reader.min.js')}}"></script>

    <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('assets/js/Chart.bundle.min.js')}}"></script>

    <script src="https://js.pusher.com/4.3.1/pusher.min.js"></script>



    <script>

          // Enable pusher logging - don't include this in production
          Pusher.logToConsole = true;

          var pusher = new Pusher('1628162809d1d8d59c80', {
             cluster: "ap1",
            encrypted: true
          });

          // Subscribe to the channel we specified in our Laravel Event
          var channel = pusher.subscribe('burmateahouse');

//         channel.bind('pusher:subscription_succeeded', function(members) {
//      alert('successfully subscribed!');
//  });
          // Bind a function to a Event (the full Laravel class)
        //   channel.bind('App\\Events\\OrderNoti', function(data) {
        //     alert(JSON.stringify(data));
        //   });

        channel.bind("order-noti", (data) => {
            alert(data);
            var voucherId = data.voucherId;
            // 0-storeshoporder  1-addmoreitem   2-storevoucher
            var url1 = "{{route('kitchen.voucher','voucherNo')}}";
            var url11 =url1.replace('voucherNo', voucherId);

            var url2 = "{{route('kitchen.addvoucher','voucherNo')}}";
            var url22 =url2.replace('voucherNo', voucherId);

            var url3 = "{{route('shop_order_voucher','voucherNo')}}";
            var url33 =url3.replace('voucherNo', voucherId);
            if(data.status==0){
                var html = `
                <div class="row mb-2">
                        <a class="kitchennoti pt-1 ml-auto" href="${url11}">
                            <p class="pr-1 pt-2">Kitchen New</p>
                        </a>
                </div>
                `;

            }
             else if(data.status==1){
                var html = `
                <div class="row mb-2">
                        <a class="kitchennoti ml-auto pt-1" href="${url22}">
                            <p class="pr-1 pt-2">Kitchen Add</p>
                        </a>
                </div>
                `;

            }
            else{
                var html = `
                    <div class="row mb-2">
                        <a class="ordernoti ml-auto pt-1" href="${url33}">
                            <p class="pr-3 pt-2">Voucher</p>
                        </a>
                    </div>

                `;
            }

        $('.noti').append(html);

        });

        // <div class="row mb-2">
        //                 <a class="kitchennoti ml-auto" href="{{route('shop_order_voucher',186)}}">
        //                     <p class="pr-4">Kitchen</p>
        //                 </a>
        // </div>
    </script>
    @yield('js')
    <script src="{{asset('js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>

<script>

setInterval(() => {
            var rolename= $('#unique_role').val();

            // alert(rolename);
            var mobileprint = localStorage.getItem('mobileprint');
           if(rolename==1){
            //    alert(rolename);

               $.ajax({

                type:'POST',

                url:'/mobile-print',

                data:{
                    "_token":"{{csrf_token()}}",
                },

                success:function(data){
                    // alert(mobileprint);
                    if(mobileprint==null){
                        mobileprint = 0;
                    }

                  if(data){

                    if(data.order_table.id>mobileprint){
                    var items= ``;
                    var jj=0;
                    // alert(data.tableno.table.table_number);
                    $.each(data.name, function(i,v){

                        if(v.menu_item.cuisine_type_id == 1){
                        items+=`
                        <tr style="width:100%; font-size:12px">
                            <td>(Salad)</td>
                            <td>${v.menu_item.item_name}</td>
                            <td>${v.name}</td>
                            <td>${data.optqty[jj].quantity - data.optqty[jj].old_quantity}</td>
                        </tr>
                        <tr>
                        <th class="text-danger font-weight-bold">Notes</th>
                        <td class="text-danger" colspan="3">${data.optqty[jj].note}</td>
                        </tr>
                        `;
                    }
                    else if(v.menu_item.cuisine_type_id == 2){
                        items+=`
                        <tr style="width:100%; font-size:12px">
                            <td>(Breakfast)</td>
                            <td>${v.menu_item.item_name}</td>
                            <td>${v.name}</td>
                            <td>${data.optqty[jj].quantity - data.optqty[jj].old_quantity}</td>
                        </tr>
                        <tr>
                        <th class="text-danger font-weight-bold">Notes</th>
                        <td class="text-danger" colspan="3">${data.optqty[jj].note}</td>
                        </tr>
                        `;
                    }
                    else if(v.menu_item.cuisine_type_id == 3){
                        items+=`
                        <tr style="width:100%; font-size:12px">
                            <td>(Healthy Food)</td>
                            <td>${v.menu_item.item_name}</td>
                            <td>${v.name}</td>
                            <td>${data.optqty[jj].quantity - data.optqty[jj].old_quantity}</td>
                        </tr>
                        <tr>
                        <th class="text-danger font-weight-bold">Notes</th>
                        <td class="text-danger" colspan="3">${data.optqty[jj].note}</td>
                        </tr>
                        `;
                    }
                    else if(v.menu_item.cuisine_type_id == 4){
                        items+=`
                        <tr style="width:100%; font-size:12px">
                            <td>(Main)</td>
                            <td>${v.menu_item.item_name}</td>
                            <td>${v.name}</td>
                            <td>${data.optqty[jj].quantity - data.optqty[jj].old_quantity}</td>
                        </tr>
                        <tr>
                        <th class="text-danger font-weight-bold">Notes</th>
                        <td class="text-danger" colspan="3">${data.optqty[jj].note}</td>
                        </tr>
                        `;
                    }
                    else if(v.menu_item.cuisine_type_id == 5){
                        items+=`
                        <tr style="width:100%; font-size:12px">
                            <td>(Snacks)</td>
                            <td>${v.menu_item.item_name}</td>
                            <td>${v.name}</td>
                            <td>${data.optqty[jj].quantity - data.optqty[jj].old_quantity}</td>
                        </tr>
                        <tr>
                        <th class="text-danger font-weight-bold">Notes</th>
                        <td class="text-danger" colspan="3">${data.optqty[jj].note}</td>
                        </tr>
                        `;
                    }
                    jj = jj + 1;
                    });
                        // alert('success hello');
                        var html = `
                        <div class="row justify-content-center">
                <div class="col-md-5 printableArea" style="width:100%;" id="printableArea">
                    <div class="card card-body">
                        <div class="row" style="margin:10px">
                            <div class="col-md-12">
                            <div style="text-align:center;">
                                <address>
                                    <b style="font-size:17px;">Law Ka Nat&nbsp;&nbsp;(<span class="text-danger">Kitchen</span>)</b><br>
                                        <b style="font-size:17px;">Restaurant</b>

                                </address>
                            </div>
                            <div class="pull-right text-left" style="margin-top:20px;">
                                    <b style="font-size:16px;">Waiter Name : ${data.waiter}</b><br>
                                    <b style="font-size:16px;">Date : <i class="fa fa-calendar"></i> ${data.date}</b><br>
                                    <b style="font-size:16px;">Table-Number : ${data.tableno.table.table_number}</b><br>
                                </font>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top:12px;">
                            <div class="table-responsive" style="clear: both;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Kitchen</td>
                                            <td>Menu Name</td>
                                            <td>Option & Size</td>
                                            <td >Qty</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         ${items}
                                    </tbody>
                                </table>
                                <h6 class=" font-weight-bold" style="text-align:center;">***************</h6>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                        </div>
                        `;
            $('#mobileprint').html(html);
            localStorage.setItem('mobileprint',JSON.stringify(data.order_table.id));

            var printContent = $('#mobileprint')[0];
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write('<html><head><title>Print Voucher</title>');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" href="css/style.css">');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" media="print" href="css/print.css">');
            WinPrint.document.write('</head><body >');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.write('</body></html>');

            // WinPrint.document.write(html);
            WinPrint.focus();
            WinPrint.print();
            WinPrint.document.close();
            WinPrint.close();
            }

                }
        }
    });
           }
        }, 3000);

        $( document ).ready(function() {
            $.ajax({

type:'POST',

url:'/getnotification',

data:{
    "_token":"{{csrf_token()}}",
},

success:function(data){
    var html = '';
    if(data.shop.length != 0 ){
        // alert('hey');
        html += `
        <a href="{{route('pending_lists')}}">
            <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
            <div class="mail-contnet">
                <h5>Pending Shop Order List<span class="badge badge-danger float-right" id="stockNoti"></span></h5>
                <small>Check Orders</small>
            </div>
        </a>
        `;
        $('#noti').html(html);
    }
    if(data.deli.length != 0){
        // alert(count(data.deli));
        // alert(data.deli.length);
        html += `
        <a href="{{route('delivery_pending_lists')}}">
            <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
            <div class="mail-contnet">
                <h5>Pending Delivery Order List<span class="badge badge-danger float-right" id="stockNoti"></span></h5>
                <small>Check Orders</small>
            </div>
        </a>
        `;
        $('#noti').html(html);
    }
}
})
          });


    </script>

</body>

</html>
