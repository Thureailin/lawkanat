@extends('master')

@section('title','Create Purchase')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Create Purchase</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Create Purchase</li>
    </ol>
</div>

@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold">Create Purchase</h2>
    </div>
</div>

<div class="row">
    <div class="col-7">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Create Purchase</h4>

                <form class="form-material m-t-40" method="post" action="{{route('store_purchase')}}">
                    @csrf

                    <div class="form-group">    
                        <label class="font-weight-bold">Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control"> 
                    </div>
                    
                    <div class="form-group">    
                        <label class="font-weight-bold">Supplier Name</label>
                        <input type="text" name="supp_name" class="form-control" placeholder="Enter Supplier Name"> 
                    </div>

                    <div id="unit_place" class="form-group">
                        <label class="font-weight-bold">Ingredient Lists</label>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Name</label>
                            </div>
                            <div class="col-md-2">
                                <label>Quantity</label>
                            </div>
                            <div class="col-md-3">
                                <label>Unit</label>
                            </div>
                            <div class="col-md-2">
                                <label>Price</label>
                            </div>
                            
                        </div>

                    </div>                

                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save Unit">
                </form>
            </div>
        </div>
    </div>

    <div class="col-5">
        <div class="card shadow">
            
            <div class="form-group m-2"> 

                <label class="font-weight-bold">Choose Ingredient</label> 

                
                <select class="form-control select2 m-b-10" style="width: 100%" id="ingredient" onchange="fillUnit(this.value)">
                    <option>Choose Ingredients</option>
                    @foreach($ingredients as $ingre)
                        <option value="{{ $ingre->unit}}">{{$ingre->name}}</option>
                    @endforeach
                </select>

            </div>
            
            <div class="form-group m-2">    
                <label class="font-weight-bold">Unit</label>
                <input type="text" id="unit" class="form-control" > 
            </div> 

            <div class="form-group m-2">    
                <label class="font-weight-bold">Quantity</label>
                <input type="number" id="qty" class="form-control" > 
            </div>

            <div class="form-group m-2">    
                <label class="font-weight-bold">Price</label>
                <input type="number" id="price" class="form-control"> 
            </div>

            <div class="form-actions m-2">
                <button type="submit" class="btn btn-success float-right" id="add"> 
                    <i class="fa fa-check"> </i> Add
                </button>
            </div>
                       
        </div>
    </div>
</div>
@endsection


@section('js')

<script type="text/javascript">

    $(document).ready(function(){

        $(".select2").select2();
    });


    var count = 0

    $('#add').click(function(event){

        event.preventDefault();

        var html = "";
        
        count + 1;
   
        var price = $('#price').val();

        var qty = $('#qty').val();
        
        var unit = $('#unit').val();

        var ingredient_id = $('#ingredient').val();

        var ingredient_name = $('#ingredient option:selected').text();

        if($.trim(price) == '' || $.trim(qty) == '' || $.trim(ingredient_id) == '')
        {
            swal({

                title:"Failed!",
                text:"Please fill all basic unit field",
                icon:"info",
                timer: 3000,
            });
            
        }else{

            html+=`<div class="form-group" id="removeclass_${count}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" name="ingredient[]" value="${ingredient_id}">
                                    <input type="text" class="form-control" value="${ingredient_name}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="qty[]" value="${qty}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="unit[]" value="${unit}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="price[]" value="${price}" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn-danger" type="button" onclick="remove_education_fields(${count});"> 
                                    <i class="fa fa-minus"></i> 
                                </button>
                            </div>
                        </div>
                   </div>`

            $("#unit_place").append(html);   

            formClear(); 
        }   
    });

    function remove_education_fields(rid) {

        console.log(rid);
        
        $('#removeclass_' + rid).remove();
    }

    function formClear() {

        $("#qty").val("");

        $("#price").val("");   
    }
    
    function fillUnit(value){
        $("#unit").val(value);
    }

    
</script>


@endsection