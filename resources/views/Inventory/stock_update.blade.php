@extends('master')

@section('title','Stock Count Update')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Branch</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Stock Count Update</li>
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
        <h2 class="font-weight-bold text-info">Stock Count Update</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-info">Stock Count Update</h4>
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
                                <th class="text-info">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($all_ingre as $allingre)
                            <tr>
                            <td>{{$allingre->name}}</td>
                                <td>{{$allingre->purchase_price}}</td>
                                <td>{{$allingre->unit}}</td>
                                <td>{{$allingre->reorder_quantity}}</td>
                                <td>{{$allingre->instock_quantity}}</td>
                                <td>{{$allingre->brand_name}}</td>
                                
                                <td>{{$allingre->supplier_name}}</td>
                                <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="update_stock('{{$allingre->id}}','{{$allingre->name}}')">Edit</button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{route('upadate_onlystock')}}" method="post">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="ingname"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <input type="hidden" name="ingreID" id="ingreID">
      <label>Stock Quantity</label>
      <input type="text" class="form-control" name="stock" id="stock">
      <input type="hidden" id="ingree_ID" name="ingid">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function update_stock(value,name){
    ingname.innerText = name;
    var ingreID = value;
    $.ajax({
           type:'POST',
           url:'/edit_count',
           data:{
               "_token":"{{csrf_token()}}",
               "ingre_ID" :ingreID,
           },
           success:function(data){
            //   alert(data.id);
           
            $('#stock').val(data.instock_quantity);
            $('#ingree_ID').val(data.id);
           },
        });
    
}
</script>
@endsection
