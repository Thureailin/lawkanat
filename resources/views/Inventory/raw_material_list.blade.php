@extends('master')

@section('title','Ingredient List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Ingredient List</li>
    </ol>
</div>

@endsection

@section('content')

<style>

    th {
        overflow:hidden;
        white-space: nowrap;
    }

    td {
        overflow:hidden;
        white-space: nowrap;
    }

</style>

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold text-info">Ingredient List</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-info">Ingredient List</h4>
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
                                <th class="text-center text-info">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingredient_lists as $ingredient)
                            <tr>
                                <td>{{$ingredient->name}}</td>
                                <td>{{$ingredient->purchase_price}} MMK</td>
                                <td>{{$ingredient->unit}}</td>
                                <td>{{$ingredient->reorder_quantity}}</td>
                                <td>{{$ingredient->instock_quantity}}</td>
                                <td>{{$ingredient->brand_name}}</td>
                                <td>{{$ingredient->supplier_name}}</td>
                                <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="edit_ingredient('{{$ingredient->id}}')">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{route('update_ingre')}}" method="post">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Ingredient Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <input type="hidden" name="ingreID" id="ingreID">
      <label>Ingredient Name</label>
      <input type="text" class="form-control font-weight-bold" name="ingre_name" id="ingre_name">
      <label>Purchase Price</label>
      <input type="text" class="form-control font-weight-bold" name="purchase" id="purchase">
      <label>Unit</label>
      <input type="text" class="form-control font-weight-bold" name="unit" id="unit">
      <label>Reorder Qty</label>
      <input type="text" class="form-control font-weight-bold" name="reorder" id="reorder">
      <label>Instock Qty</label>
      <input type="text" class="form-control font-weight-bold" name="instock" id="instock">
      <label>Brand Name</label>
      <input type="text" class="form-control font-weight-bold" name="brand" id="brand">
      <label>Supplier Name</label>
      <input type="text" class="form-control font-weight-bold" name="supplier" id="supplier">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-info">Ingredient Create Form</h3>
                <form class="form-material m-t-40" method="post" action="{{route('store_ingredient')}}" enctype='multipart/form-data'>
                    @csrf
                       
                    <div class="form-group">    
                        <label class="font-weight-bold text-info">Ingredient Name</label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Ingredient Name" required>

                        @error('name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror 

                    </div>

                    <div class="form-group">
                        <label class="control-label text-info">Purchase Price</label>

                        <input type="number" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="Enter Purchase Price" required>

                        @error('purchase_price')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">    
                        <label class="font-weight-bold text-info">Measuring Unit</label>

                        <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Enter Unit" required>

                        @error('unit')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror


                    </div>

                    <div class="form-group">
                        <label class="control-label text-info">Reorder Qty</label>

                        <input type="number" name="reorder_qty" class="form-control @error('reorder_qty') is-invalid @enderror" placeholder="Enter Reorder Qty" required>

                         @error('reorder_qty')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="control-label text-info">Instock Qty</label>

                        <input type="number" name="instock_qty" class="form-control @error('instock_qty') is-invalid @enderror" placeholder="Enter Instock Qty" required>

                         @error('instock_qty')
                            <span instock_qty="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label text-info">Brand Name</label>

                        <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Enter Brand Name" required>

                         @error('brand_name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label text-info">Supplier Name</label>

                        <input type="text" name="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror" placeholder="Enter Supplier Name" required> 

                        @error('supplier_name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function edit_ingredient(value)
{
    // alert(value);
    var ingre_id = value;
    $.ajax({
           type:'POST',
           url:'/edit_ingredient',
           data:{
               "_token":"{{csrf_token()}}",
               "ingredient_id" :ingre_id,
           },
           success:function(data){
            //   alert(data.name);
            $('#ingreID').val(data.id);
            $('#ingre_name').val(data.name);
            $('#purchase').val(data.purchase_price);
            $('#unit').val(data.unit);
            $('#reorder').val(data.reorder_quantity);
            $('#instock').val(data.instock_quantity);
            $('#brand').val(data.brand_name);
            $('#supplier').val(data.supplier_name);
           },
        });
}
</script>
@endsection
