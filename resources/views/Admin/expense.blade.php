@extends('master')

@section('title','Expenses List')

@section('place')

@section('place')

<div class="col-md-11 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Purchase Expenses List</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Purchase Expenses List</li>
    </ol>
</div>
<div class="col-md-1 col-12 align-self-center">
    <a href="{{route('export-expenses')}}" class="btn btn-info btn-m btn-block" onclick="getexport()">Export</a>
</div>

@endsection

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="row filter-row">

                            <div class="col-sm-4 col-md-6">
                                <div class="form-group form-focus select-focus">
                                    <label class="focus-label">Choose Date</label>
                                    <input type="date" name="purchase_date" id="purchase_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-2" style="margin-top:30px;">
                                <button class="btn btn-info btn-m btn-block mt-1" onclick="searchPurchase(this.value)" value="1" >Search</button>
                            </div>
                            <div class="col-sm-4 col-md-1" style="margin-top:30px;">
                                <button class="btn btn-info btn-m btn-block mt-1" onclick="searchPurchase(this.value)" value="2" ><i class="fa fa-plus"></i>Add</button>
                            </div>
                            <input type="hidden" name="search_add" id="search_add">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row" id="purchase_list">

            <div class="col-md-8 col-lg-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title">Purchase Expense List Table</h4>
                        <div class="table-responsive" id="slimtest2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>date</th>
                                        <th>description</th>
                                        <th>amount</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h5 class="m-0 font-weight-bold text-primary">Purchase Expense  Form</h5>
                    </div>
                    <div class="card-body">
                       {{-- <form method="POST" action="">
                           @csrf --}}
                           <input type="hidden" name="purchase_id" id="purchase_id">

                            <div class="form-group">
                               <label>Title</label>
                               <input type="text" name="code" class="form-control" id="title">
                            </div>

                            <div class="form-group">
                               <label>Purchase Expense Date</label>
                               <input type="text" name="name" class="form-control" id="date">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="name" class="form-control" id="description">
                             </div>

                             <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="name" class="form-control" id="amount">
                             </div>

                            <div class="edit_exp m-t-20 text-center">
                                <button class=" btn btn-primary submit-btn" onclick="new_edit_Expense(this.value)" value="1">Edit Purchase Expense</button>
                            </div>

                            <div class="new_exp m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" onclick="new_edit_Expense(this.value)" value="2">Add Purchase Expense</button>
                            </div>

                       {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>



@endsection

@section('js')

<script src="{{asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>

<script type="text/javascript">
      $(document).ready(function(){

        $("#purchase_list").hide();

        $('#slimtest2').slimScroll({
            color: '#00f',
            height: '400px'
        });

        $('#table_body').on('click','#editbtn',function(){

            $(".edit_exp").show();
            $(".new_exp").hide();

        var id = $(this).data('id');
        $("#purchase_id").attr('value', id);

        var title = $(this).data('title');
        $("#title").attr('value', title);

        var date = $(this).data('date');
        $("#date").attr('value', date);

        var description = $(this).data('description');
        $("#description").attr('value', description);

        var amount = $(this).data('amount');
        $("#amount").attr('value', amount);

        })

        $('#table_body').on('click','#editbtn2',function(){

        $(".edit_exp").show();
        $(".new_exp").hide();

        var id = $(this).data('id2');
        $("#purchase_id").val(id);

        var title = $(this).data('title2');
        $("#title").val(title);

        var date = $(this).data('date2');
        $("#date").val(date);

        var description = $(this).data('description2');
        $("#description").val(description);

        var amount = $(this).data('amount2');
        $("#amount").val(amount);

        })

        });
    $('.dropify').dropify();

    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });

    $('#mdate').prop("disabled",true);
    $('#period').prop("disabled",true);

    function showPeriod(value){

        var show_options = value;

        if( show_options == 1){
            $('#mdate').prop("disabled",true);
            $('#period').prop("disabled",false);
            }

        else{

            $('#mdate').prop("disabled",false);
            $('#period').prop("disabled",true);
        }
    }

    function searchPurchase(val){
        // alert(val);
        $('#table_body').empty();
        var date = $('#purchase_date').val();
        $.ajax({

            type:'POST',

            url:'AjaxSearchPurchase',

            data:{
            "_token":"{{csrf_token()}}",
            "date":date,
            },

            success:function(data){
                if(val == 1){
                    $("#purchase_list").show();
                    $('#date').val(date);
                    $(".new_exp").hide(date);
                    $("#search_add").val(val);
                    $(".edit_exp").show();
                    $(".new_exp").hide();
                }else{
                    $("#purchase_list").show();
                    $('#date').val(date);
                    $(".edit_exp").hide();
                    $("#search_add").val(val);
                    $(".edit_exp").hide();
                     $(".new_exp").show();
                }


                $.each(data, function(i, value) {

                    let button = `<a class="btn btn-outline-warning" id="editbtn" data-id="${value.id}" data-title="${value.title}" data-date="${value.date}" data-description="${value.description}" data-amount="${value.amount}">Edit</a>
                    <a class="btn btn-outline-danger" id="deletebtn" data-id="${value.id}">Delete</a>
                    `;


                    $('#table_body').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(value.title)).append($('<td>').text(value.date)).append($('<td>').text(value.description)).append($('<td>').text(value.amount)).append($('<td>').append($(button)));

                });

            }
        })
    }

    function new_edit_Expense(new_edit){
        // alert('hello');
        $('#table_body').empty();
        let purchase_id = $('#purchase_id').val();
        let title = $("#title").val();
        let date = $("#date").val();
        let description = $("#description").val();
        let amount = $('#amount').val();
        let val = $("#search_add").val();
        $.ajax({

        type:'POST',

        url:'newOreditPurchase',

        data:{
            "_token":"{{csrf_token()}}",
            "purchase_id":purchase_id,
            "title":title,
            "date":date,
            "description":description,
            "amount":amount,
            // "edit_new" : new_edit;
        },

    success:function(data){
    //    alert('success');
        if(val == 1){
            $("#purchase_list").show();
            $('#date').val(date);
            $(".new_exp").hide(date);
            $("#search_add").val(val);
        }else{
            $("#purchase_list").show();
            $('#date').val(date);
            $(".edit_exp").hide();
            $("#search_add").val(val);
        }
        $.each(data, function(i, value) {

        let button = `<a class="btn btn-outline-warning" id="editbtn2" data-id2="${value.id}" data-title2="${value.title}" data-date2="${value.date}" data-description2="${value.description}" data-amount2="${value.amount}">Edit</a>
        <a class="btn btn-outline-danger" id="deletebtn2" data-id="${value.id}">Delete</a>
        `;


        $('#table_body').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(value.title)).append($('<td>').text(value.date)).append($('<td>').text(value.description)).append($('<td>').text(value.amount)).append($('<td>').append($(button)));

        });
        $("#title").val('');
        // $("#date").val('');
        $("#description").val('');
        $('#amount').val('');
        }
     })
    }

    $('#table_body').on('click','#deletebtn',function(){
        alert('hello');
        $('#table_body').empty();
        let id = $(this).data('id');
        let date = $("#date").val();
         let val = $("#search_add").val();

        $.ajax({

            type:'POST',

            url:'deletePurchaseExpense',

            data:{
                "_token":"{{csrf_token()}}",
                "id":id,
                "date" : date,
            },

            success:function(data){
                if(val == 1){
            $("#purchase_list").show();
            $('#date').val(date);
            $(".new_exp").hide(date);
            $("#search_add").val(val);
        }else{
            $("#purchase_list").show();
            $('#date').val(date);
            $(".edit_exp").hide();
            $("#search_add").val(val);
        }
        $.each(data, function(i, value) {

        let button = `<a class="btn btn-outline-warning" id="editbtn2" data-id2="${value.id}" data-title2="${value.title}" data-date2="${value.date}" data-description2="${value.description}" data-amount2="${value.amount}">Edit</a>
        <a class="btn btn-outline-danger" id="deletebtn2" data-id="${value.id}">Delete</a>
        `;


        $('#table_body').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(value.title)).append($('<td>').text(value.date)).append($('<td>').text(value.description)).append($('<td>').text(value.amount)).append($('<td>').append($(button)));

        });
        $("#title").val('');
        // $("#date").val('');
        $("#description").val('');
        $('#amount').val('');
            }

            })

    })

    $('#table_body').on('click','#deletebtn2',function(){
        alert('hey');
        $('#table_body').empty();
        let id = $(this).data('id');
        let date = $("#date").val();
         let val = $("#search_add").val();

        $.ajax({

            type:'POST',

            url:'deletePurchaseExpense',

            data:{
                "_token":"{{csrf_token()}}",
                "id":id,
                "date" : date,
            },

            success:function(data){
                if(val == 1){
            $("#purchase_list").show();
            $('#date').val(date);
            $(".new_exp").hide(date);
            $("#search_add").val(val);
        }else{
            $("#purchase_list").show();
            $('#date').val(date);
            $(".edit_exp").hide();
            $("#search_add").val(val);
        }
        $.each(data, function(i, value) {

        let button = `<a class="btn btn-outline-warning" id="editbtn2" data-id2="${value.id}" data-title2="${value.title}" data-date2="${value.date}" data-description2="${value.description}" data-amount2="${value.amount}">Edit</a>
        <a class="btn btn-outline-danger" id="deletebtn2" data-id="${value.id}">Delete</a>
        `;


        $('#table_body').append($('<tr>')).append($('<td>').text(++i)).append($('<td>').text(value.title)).append($('<td>').text(value.date)).append($('<td>').text(value.description)).append($('<td>').text(value.amount)).append($('<td>').append($(button)));

        });
       $("#title").val('');
        // $("#date").val('');
        $("#description").val('');
        $('#amount').val('');
            }

            })

    })




</script>

@endsection
