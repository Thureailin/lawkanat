@extends('master')

@section('title', 'State List')

@section('content')

<div class="row">
    <div class="col-sm-5 col-5">
        <h4 class="page-title font-weight-bold">State and Town List</h4>
    </div>
    <div class="col-sm-7 col-7 text-right m-b-30">
        <a href="#" class="btn btn-primary btn-rounded" data-target="#add_town" data-toggle="modal"><i class="fa fa-plus"></i> Add Town</a>

        <div id="add_town" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h3>Towns!</h3>
                        <hr>
                        <form action="{{route('store_town')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Town Code</label>
                                <input class="form-control" type="text"  name="code">
                            </div>

                            <div class="form-group">
                                <label>Town Name</label>
                                <input class="form-control" type="text"  name="name">
                            </div>

                            <div class="form-group mb-4">

                                <select class="select2 floating" style="width: 100%" name="state_id">

                                    <option value="">Select State</option>

                                    @foreach($state_lists as $doc)

                                    <option value="{{$doc->id}}">{{$doc->state_code}}-{{$doc->state_name}}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="allowdelivery" id="allowdelivery" value="1" checked>
                                <label class="form-check-label" for="manualBooking">Allow Delivery</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="allowdelivery" id="notallowdelivery" value="0">
                                <label class="form-check-label" for="notallowdelivery">Not Allow Delivery</label>
                              </div>

                              <div class="form-group mt-3">
                                <label>Delivery charges</label>
                                <input class="form-control" type="number"  name="charges">
                            </div>

                            <div class="m-t-20">
                                <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">State and Town List</h4>
                    </div>
                </div>

                <div class="row filter-row">

                    <div class="col-sm-4 col-md-6">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">States</label>
                            <select class="select2 floating" style="width: 100%" id="state_id">

                                <option value="">Search by State</option>

                                @foreach($state_lists as $doc)

                                <option value="{{$doc->id}}">{{$doc->state_code}}-{{$doc->state_name}}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3" style="margin-top:30px;">
                        <button class="btn btn-info btn-m btn-block" onclick="searchTown()">Search Towns</button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row" id="town_list">

    <div class="col-md-8 col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Town List Table</h4>
                <div class="table-responsive" id="slimtest2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Town Code</th>
                                <th>Town Name</th>
                                <th>Status</th>
                                <th>Charges</th>
                                <th>Action</th>
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
                <h5 class="m-0 font-weight-bold text-primary">Town Edit Form</h5>
            </div>
            <div class="card-body">
               {{-- <form method="POST" action="">
                   @csrf --}}
                   <input type="hidden" name="town_id" id="town_id">

                    <div class="form-group">
                       <label>Code</label>
                       <input type="text" name="code" class="form-control" id="town_code">
                    </div>

                    <div class="form-group">
                       <label>Name</label>
                       <input type="text" name="name" class="form-control" id="town_name">
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="allowdelivery" id="editallowdelivery" value="1">
                        <label class="form-check-label" for="editallowdelivery">Allow Delivery</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="allowdelivery" id="editnotallowdelivery" value="0">
                        <label class="form-check-label" for="editnotallowdelivery">Not Allow Delivery</label>
                      </div>

                      {{-- <input type="hidden" name="allow_radio" id="radio_allow"> --}}

                      <div class="form-group mt-3">
                        <label>Delivery charges</label>
                        <input class="form-control" type="number"  name="editcharges" id="editcharges">
                    </div>

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" onclick="editTown()">Edit Town</button>
                    </div>

               {{-- </form> --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>

    $(document).ready(function(){

        $(".select2").select2();

        $("#town_list").hide();

        $('#slimtest2').slimScroll({
            color: '#00f',
            height: '400px'
        });

    });

    $('#table_body').on('click','#editbtn',function(){

        var id = $(this).data('id');
        $("#town_id").attr('value', id);

        var town_code = $(this).data('town_code');
        $("#town_code").attr('value', town_code);

        var town_name = $(this).data('town_name');
        $("#town_name").attr('value', town_name);

        var charges = $(this).data('charges');
        $("#editcharges").attr('value', charges);

        var status = $(this).data('status');
        if(status== 1){
            $('#editallowdelivery').prop('checked',true);
        }
        else{
            $('#editnotallowdelivery').prop('checked',true);
        }

        })

        $('#table_body').on('click','#editbtn2',function(){
            alert('hello');
            var id = $(this).data('id2');
        $("#town_id").val(id);

        var town_code = $(this).data('town_code2');
        $("#town_code").val(town_code);

        var town_name = $(this).data('town_name2');
        $("#town_name").val(town_name);

        var charges = $(this).data('charge');
        $("#editcharges").val(charges);

        var status = $(this).data('status2');
        if(status== 1){
            $('#editallowdelivery').prop('checked',true);
        }
        else{
            $('#editnotallowdelivery').prop('checked',true);
        }

            })


    function searchTown(){

        $('#table_body').empty();

        let state_id = $("#state_id").val();

        $.ajax({

           type:'POST',

           url:'AjaxSearchTown',

           data:{
            "_token":"{{csrf_token()}}",
            "state_id":state_id,
           },

            success:function(data){

                $("#town_list").show();

                $.each(data, function(i, value) {

                    let button = `<a class="btn btn-outline-warning" id="editbtn" data-id="${value.id}" data-town_code="${value.town_code}" data-town_name="${value.town_name}" data-charges="${value.delivery_charges}" data-status="${value.status}">Edit</a>`;

                        if(value.status == 0 ){
                            statusDelivery= "<span class='text-danger'>Not Allow Delivery </span>";
                        }
                        else {
                            statusDelivery= "<span class='text-success'>Allow Delivery </span>";
                        }

                    $('#table_body').append($('<tr>')).append($('<td>').text(value.town_code)).append($('<td>').text(value.town_name)).append($('<td>').html(statusDelivery)).append($('<td>').text(value.delivery_charges)).append($('<td>').append($(button)));

                });

            },

        });


    }

  function editTown(){
    //   alert('hello');
    $('#table_body').empty();

    let state_id = $("#state_id").val();
    let town_id = $("#town_id").val();
    let town_code = $("#town_code").val();
    let town_name = $('#town_name').val();
    let editcharges = $('#editcharges').val();
    let allowOrNot;

    if($('#editnotallowdelivery').prop('checked')){
        // alert('hello');
       allowOrNot = 0;
        // alert(allowOrNot);
    }
    else if($('#editallowdelivery').prop('checked')){
        // alert('hel;lo');
        allowOrNot = 1;
        // alert(allowOrNot);
    }

            $.ajax({

            type:'POST',

            url:'EditTown',

            data:{
                "_token":"{{csrf_token()}}",
                "town_id":town_id,
                "state_id":state_id,
                "town_code":town_code,
                "town_name":town_name,
                "editcharges":editcharges,
                "allowdelivery" : allowOrNot,
            },

                success:function(data){
                    // alert('hello');
                    $("#town_list").show();

                $.each(data, function(i, value) {
                    if(value.status == 0 ){
                            statusDelivery= "<span class='text-danger'>Not Allow Delivery </span>";
                            var delicharges = '';
                        }
                        else {
                            statusDelivery= "<span class='text-success'>Allow Delivery </span>";
                            var delicharges = value.delivery_charges;
                        }

                    let button = `<a class="btn btn-outline-warning" id="editbtn2" data-id2="${value.id}"  data-town_name2="${value.town_name}" data-charge="${delicharges}"  data-town_code2="${value.town_code}" data-status2="${value.status}">Edit</a>`;

                    $('#table_body').append($('<tr>')).append($('<td>').text(value.town_code)).append($('<td>').text(value.town_name)).append($('<td>').html(statusDelivery)).append($('<td>').text(delicharges)).append($('<td>').append($(button)));

                });
            }
        })
  }




</script>


@endsection
