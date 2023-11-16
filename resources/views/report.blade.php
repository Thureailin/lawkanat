@extends('master')
@section('title', 'Dashboard')
@section('content')

<style>

</style>
<div class="content">
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4">
                <div class="card-body">
                    <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Today Sale</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                        <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;"> {{$today_sale}} Ks</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                            <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                     <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Total Income Amount</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                            <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$total_sale}} Ks</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Total Purchase Amount</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                            <span class="h2 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$total_expense}}  Ks</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Total Profit & Loss</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                            <span class="h2 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$total_sale - $total_expense}}  Ks</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="col-xl-1 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Menu</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                        <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$menu}}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                            <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}
</div>

    {{-- <div class="row md-12">
		<div class="col-md-12">
            <div class="card card-stats mb-4" >
                <div class="card-body font-weight-bold">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2 font-weight-bold  ">Day</label>
                            <input type="date" name="receive_day" id="receive_day" class="border border-outline border-primary p-1" style="border-radius: 7px;" onchange="getday(this.value)">

                        </div>

                        <div class="col-md-4 st_week" style="padding-left:50">
                            <label style="color:rgb(34, 190, 241)" class="pl-4 ml-2 pt-2 font-weight-bold  ">Week</label>
                            <input type="week" name="receive_week" id="receive_week" class="border border-outline border-primary p-1" style="border-radius: 7px;" onchange="getfamousweek(this.value)">
                        </div>

                        <div class="col-md-4 st_month">
                            <label style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2 font-weight-bold  ">Month</label>
                            <input type="month" name="receive_month" id="receive_month" class="border border-outline border-primary p-1" style="border-radius: 7px;" onchange="getfamousmonth(this.value)">
                        </div>

                    </div>
                    <div class="main" id="main1">
                        <canvas id="densityChart" height="110"></canvas>
                    </div>

                </div>
            </div>
		</div>



	</div> --}}

    <div class="row md-12">
		{{-- <div class="col-md-4">
            <div class="card card-stats mb-4" >
                <div class="card-body font-weight-bold">
                    <h5>Today Status</h5>
                    <div class="row mt-4" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Order
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <div class="row mt-4" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Delivery Order
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <div class="row mt-4" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Voucher Cancel
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <div class="row mt-4" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Unbreak Menu Item
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>

                    <div class="row mt-4" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Purchase
                        </div>
                        <div class="col-md-4" id="testcolor">

                        </div>
                    </div>


                </div>
            </div>
		</div> --}}
        <div class="col-md-6">
            <div class="card card-stats mb-4" >
                <div class="card-body font-weight-bold text-center">
                    <h5>Top Five Famous Menu Item</h5>
                    <div class="row ml-5" id="famous_item">

                    </div>
                </div>
            </div>
		</div>

        <div class="col-md-6">
            <div class="card card-stats mb-4" >
                <div class="card-body font-weight-bold text-center">
                    <h5>Five Unfamous Menu Item</h5>
                    <div class="row ml-5" id="unfamous_item">

                    </div>
                </div>
            </div>
		</div>
	</div>

	<div class="row md-12">

	    <div class="col-md-6">
        <div class="card p-4">

            {{-- <div class="row ml-1">
                <div class="col-md-3 mt-2">
                    {{-- <label style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2 font-weight-bold  ">Data Type</label>
                    <select class="form-control rounded border border-primary" id="data_type" style="font-size: 12px;" onchange="search_compare_data(this.value)">
                    <option>Type</option>
                        <option value="1">Order Fulfillment</option>
                        <option value="2">Cash Collection</option>
                        <option value="3">Supplier Repayment</option>
                        <option value="4">Inventory Level</option>
                    </select> --}}
                {{-- </div>

            </div> --}}

            <div class="main">
                <canvas id="barChart" height="180"></canvas>
            </div>
        </div>
        </div>


		<div class="col-md-6">
		   <div class="card">
            <div class="col-md-3 mt-2">

                <label class="control-label text-success font-weight-bold">Monthly</label>
                <select class="form-control custom-select" id="monthly" onchange="getmonthpie(this.value)">
                    <option value="">Months</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

            </div>

            <div class="main" id="main">
                <canvas id="pieChart"></canvas>
            </div>

          </div>
		</div>




	</div>

    <input type="hidden" id="total_sale" value="{{$total_sale}}">
    <input type="hidden" id="total_purchase" value="{{$total_inventory}}">
    <input type="hidden" id="total_expense" value="{{$total_expense}}">

</div>



@endsection

@section('js')

<script>

    $('#slimtest1').slimScroll({
        height: '400px'
    });

    $('#slimtest2').slimScroll({
        height: '400px'
    });
    function getfamousweek(value)
    {
        // alert(value);
        $.ajax({
           type:'POST',
           url:'/getFamousWeek',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "famous_week":value,
                "type" : 2,
            },

           success:function(data){
            $('#densityChart').remove(); // this is my <canvas> element
           $('#main1').append('<canvas id="densityChart" height="100"><canvas>');
            var menu_arr_famous = [];
            var menu_arr_count_famous = [];
            var qty = [];
            var i=0;
            var j=0;
            for(i=0;i<data.length;i++)
            {
                if(data[i].count > 1)
                {
                    menu_arr.push(data[i].menu)
                }
            }
            for(j=0;j<data.length;j++)
            {
                if(data[j].count > 1)
                {
                menu_arr_count_famous.push(data[j].count)
                }
            }
            // alert(menu_arr);
            const densityCanvas = document.getElementById("densityChart");

            let densityData = {
            label: 'Famous Menu Items',
            data: menu_arr_count_famous,
            backgroundColor: "pink",
            };

            let barChart = new Chart(densityCanvas, {
            type: 'bar',
            data: {
                labels: menu_arr_famous,
                datasets: [densityData]
            }
            });
           }
        });
    }
    function getunfamousweek(value)
    {
        // alert(value);
        $.ajax({
           type:'POST',
           url:'/getFamousWeek',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "famous_week":value,
                "type" : 2,
            },

           success:function(data){
            var menu_arr = [];
            var menu_arr_count = [];
            var qty = [];
            var i=0;
            var j=0;
            for(i=0;i<data.length;i++)
            {
                if(data[i].count <= 1)
                {
                    menu_arr.push(data[i].menu)
                }
            }
            for(j=0;j<data.length;j++)
            {
                if(data[j].count <= 1)
                {
                    menu_arr_count.push(data[j].count)
                }
            }
            // alert(menu_arr);
            const densityCanvas1 = document.getElementById("densityChart1");

            let densityData1 = {
            label: '10 Famous Menu Items',
            data: menu_arr_count,
            backgroundColor: "pink",
            };

            let barChart = new Chart(densityCanvas1, {
            type: 'bar',
            data: {
                labels: menu_arr,
                datasets: [densityData1]
            }
            });
           }
        });
    }
    function getday(value)
    {
        // alert(value);
        $.ajax({
           type:'POST',
           url:'/getFamousWeek',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "famous_day":value,
                "type" : 1
            },

           success:function(data){
            var menu_arr_famous = [];
            var menu_arr_count_famous = [];
            var qty = [];
            var i=0;
            var j=0;
            for(i=0;i<data.length;i++)
            {
                if(data[i].count > 1)
                {
                    menu_arr.push(data[i].menu)
                }
            }
            for(j=0;j<data.length;j++)
            {
                if(data[j].count > 1)
                {
                menu_arr_count_famous.push(data[j].count)
                }
            }
            // alert(menu_arr);
            const densityCanvas = document.getElementById("densityChart");

            let densityData = {
            label: 'Famous Menu Items',
            data: menu_arr_count_famous,
            backgroundColor: "pink",
            };

            let barChart = new Chart(densityCanvas, {
            type: 'bar',
            data: {
                labels: menu_arr_famous,
                datasets: [densityData]
            }
            });
           }
        });
    }
    function getmonthpie(value){
        $.ajax({
           type:'POST',
           url:'/getmonthpie',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "pie_month":value,
            },

           success:function(data){
            $('#pieChart').remove(); // this is my <canvas> element
           $('#main').append('<canvas id="pieChart"><canvas>');
            var total_sales = data.total_sale;
          var total_purchase = data.total_purchase;
           var other_expense = data.total_expense;

                var net_profit = total_sales  - (other_expense);



                var income_total = total_sales ;

                var total_sales_percent =  (total_sales / income_total) * 100;


                var other_exp_percent = (other_expense / income_total) * 100;


                var raw_purchase_percent = (total_purchase/income_total) * 100;


                var net_profit_percent = (net_profit / income_total) *100;

                var canvas = document.getElementById("pieChart");
                var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "Total Sales (" + total_sales + " Ks)",
                        // "Total Purchase (" + total_purchase + " Ks)",
                        "Other Expense (" + other_expense + " Ks)",
                        "Net Profit (" + net_profit + " Ks)"
                    ],
                    datasets: [
                        {
                            label: "Monthly Total Income(" + income_total + "Ks)",
                            fill: false,
                            backgroundColor: [

                                'rgba(255,99,132,0.6)',
                                // 'rgba(54,162,235,0.6)',
                                'rgba(255,206,86,0.6)',
                                'rgba(75,192,192,0.6)',

                            ],
                            data: [total_sales_percent,other_exp_percent,50]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Profit and Loss",
                        position: "top",
                        fontSize: 20
                    },
                    legend:{
                        position: 'right'
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myLineChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });
           }
        })

    }
    $(document).ready(function(){
        // bar chart famous menu
        // alert('hello');
        $.ajax({
           type:'POST',
           url:'/getWeekNowFamous',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){

            var html = ''; var html1 = '';
            $.each(data.famous_item,function(i,v){
                html += `
                <div class="col-md-8 mt-4 ml-5" >
                    ${v}
                </div>
                `;
            })
            $('#famous_item').html(html);
            $.each(data.unfamous_item,function(i,b){
                html1 += `
                <div class="col-md-8 mt-4 ml-5" >
                    ${b}
                </div>
                `;
            })
            $('#unfamous_item').html(html1);
           }
           });


        ///////////////////////
        $.ajax({
           type:'POST',
           url:'/getOrderFullfill',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Sale Amount",
                            fill: false,
                            backgroundColor: 'rgba(54,162,235,0.6)',

                            data: [data.jan_income,data.feb_income,data.mar_income,data.apr_income,data.may_income,data.jun_income,data.jul_income,data.aug_income,data.sep_income,data.oct_income,data.nov_income,data.dec_income]
                        },
                        // {
                        //     label: "Unfamous Menu Items",
                        //     fill: false,
                        //     backgroundColor: 'rgba(255,99,132,0.6)',
                        //     data: [100,200,300,400,500,600,700,600,500,400,300,200]
                        // }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Sale Fulfillment",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

        $.ajax({
           type:'POST',
           url:'/getMonth',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_month":'2022-0',
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart
              var first_week_salesamt = data.first_week_salesamt;
              var second_week_salesamt = data.second_week_salesamt;
              var third_week_salesamt = data.third_week_salesamt;
              var fourth_week_salesamt = data.fourth_week_salesamt;
              var first_week_ordersamt = data.first_week_ordersamt;
              var second_week_ordersamt = data.second_week_ordersamt;
              var third_week_ordersamt = data.third_week_ordersamt;
              var fourth_week_ordersamt = data.fourth_week_ordersamt;



            var canvas = document.getElementById("lineChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "First Week",
                        "Second Week",
                        "Third Week",
                        "Last Week",

                    ],
                    datasets: [
                        {
                            label: "Famous Menus",
                            fill: false,
                            backgroundColor:'rgba(75,192,192,0.6)',
                            data: [2000, 4000, 3000, 1000]
                        },
                        {
                            label: "Unfamous Menus",
                            fill: false,
                            backgroundColor: 'rgba(153,102,255,0.6)',
                            data: [1000, 2000, 2500, 4000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Famous and Unfamous Menus",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myLineChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

        var total_sales = parseInt($('#total_sale').val());
        var total_purchase = parseInt($('#total_purchase').val());
        var other_expense = parseInt($('#total_expense').val());

        // console.log(total_sales,total_order,total_profit,total_purchase,total_transaction,other_income,other_expense);

        // var inv = total_sales - total_profit ;

        //         var inv_percent = (inv / total_sales) * 100;

                // var total_profit_percent = (total_profit / total_sales) *100;

                var net_profit = total_sales  - (other_expense);

                var income_total = total_sales ;

                var total_sales_percent =  (total_sales / income_total) * 100;


                var other_exp_percent = (other_expense / income_total) * 100;


                var raw_purchase_percent = (total_purchase/income_total) * 100;


                var net_profit_percent = (net_profit / income_total) *100;

                var canvas = document.getElementById("pieChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "Total Sales (" + total_sales + " Ks)",
                        // "Total Purchase (" + total_purchase + " Ks)",
                        "Other Expense (" + other_expense + " Ks)",
                        "Net Profit (" + net_profit + " Ks)"
                    ],
                    datasets: [
                        {
                            label: "Monthly Total Income(" + income_total + "Ks)",
                            fill: false,
                            backgroundColor: [

                                'rgba(255,99,132,0.6)',
                                // 'rgba(54,162,235,0.6)',
                                'rgba(255,206,86,0.6)',
                                'rgba(75,192,192,0.6)',


                            ],
                            data: [total_sales_percent,other_exp_percent,net_profit_percent]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Profit and Loss",
                        position: "top",
                        fontSize: 20
                    },
                    legend:{
                        position: 'right'
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myLineChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });



    })

    function search_compare_data(value)
{
    // alert(value);
    if(value ==1)
    {
        // alert("two");


        $.ajax({
           type:'POST',
           url:'/getOrderFullfill',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Famous Menu Items",
                            fill: false,
                            backgroundColor: "#2097e1",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Unfamous Menu Items",
                            fill: false,
                            backgroundColor: "#bdd9e6",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Sale Fulfillment",
                        position: "top"
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

    } else if(value ==2)
    {
        // alert("two");


        $.ajax({
           type:'POST',
           url:'/getCashCollect',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Order Amount",
                            fill: false,
                            backgroundColor: "#2097e1",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Transaction Amount",
                            fill: false,
                            backgroundColor: "#bdd9e6",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Cash Collection",
                        position: "top"
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

    }else if(value ==3)
    {
        // alert("two");


        $.ajax({
           type:'POST',
           url:'/getSupplierRepayment',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Purchase Amount",
                            fill: false,
                            backgroundColor: "#2097e1",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Credit Repayment Amount",
                            fill: false,
                            backgroundColor: "#bdd9e6",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Supplier Repayment",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

    }

}


    function getweek(week)
    {

        $.ajax({
           type:'POST',
           url:'/getWeek',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_week":week,

            },

           success:function(data){

              var canvas = document.getElementById("lineChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        data.first_day,
                        data.second_day,
                        data.third_day,
                        data.fourth_day,
                        data.fifth_day,
                        data.sixth_day,
                        data.seventh_day

                    ],
                    datasets: [
                        {
                            label: "Sales Reveneus",
                            fill: true,
                            backgroundColor: 'rgba(75,192,192,0.6)',
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Order Revenues",
                            fill: true,
                            backgroundColor: 'rgba(153,102,255,0.6)',
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }

                    ]
                };

                // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Weekly Sales and Orders Revenue",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

                // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

                // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options,
                    plugins: labelWrap
                });
           }

        });
    }

    function getmonth(month)
    {

        $.ajax({
           type:'POST',
           url:'/getMonth',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_month":month,
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart
              var first_week_salesamt = data.first_week_salesamt;
              var second_week_salesamt = data.second_week_salesamt;
              var third_week_salesamt = data.third_week_salesamt;
              var fourth_week_salesamt = data.fourth_week_salesamt;
              var first_week_ordersamt = data.first_week_ordersamt;
              var second_week_ordersamt = data.second_week_ordersamt;
              var third_week_ordersamt = data.third_week_ordersamt;
              var fourth_week_ordersamt = data.fourth_week_ordersamt;



            var canvas = document.getElementById("lineChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "First Week",
                        "Second Week",
                        "Third Week",
                        "Last Week",

                    ],
                    datasets: [
                        {
                            label: "Sales Revenues",
                            fill: false,
                            backgroundColor: 'rgba(75,192,192,0.6)',

                            data: [100, 400, 200, 100]
                        },
                        {
                            label: "Orders Revenues",
                            fill: false,
                            backgroundColor: 'rgba(153,102,255,0.6)',
                            data: [100, 400, 200, 100]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Sales and Orders Revenues",
                        position: "top"
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myLineChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });
    }


</script>

@endsection

