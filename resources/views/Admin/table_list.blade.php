@extends('master')

@section('title','Table List')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">Table List</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Back to Dashborad</a></li>
        <li class="breadcrumb-item active">Table List</li>
    </ol>
</div>

@endsection

@section('content')

<style>

    td{
        overflow:hidden;
        white-space: nowrap;
    }


</style>

<div class="row page-titles">
    <div class="col-md-6 col-6 align-self-center">        
        <h2 class="font-weight-bold">Table List</h2>
    </div>

    <div class="col-md-3 col-3 align-self-right">

        <div class="d-flex m-t-10 justify-content-end">
             <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create_item">
                <i class="fas fa-plus"></i>                   
                Add Table
            </a>
        </div>

        <div class="modal fade" id="create_item" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Table Create Form</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>

                    <div class="modal-body">
                        <form class="form-material" method="post" action="{{route('store_table_list')}}" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-body">
                                
                                <div class="form-group">
                                    <label class="control-label">Table Type</label>
                                    <select class="form-control" name="table_type" required>
                                        <option value="">Please Choose Table Type</option>
                                        @foreach($table_type_lists as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Enter Floor</label>
                                    <input type="number" name="floor" class="form-control" placeholder="eg..1,2,3" required>
                                    <small class="form-control-feedback"> Enter Floor </small> 
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Number of Tables</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="eg..1,2,3" required>
                                    <small class="form-control-feedback"> Enter Table Quantity </small> 
                                </div>  

                                <div class="form-group">
                                    <label class="control-label">Table Number Prefix</label>
                                    <input type="number" name="table_prefix" class="form-control" placeholder="eg..01, 001" required>
                                    <small class="form-control-feedback"> Enter Table Number Prefix </small> 
                                </div>                                
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class=" col-md-9">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>           
                    </div>
                </div>
            </div>
        </div>        
    </div> 

    <div class="col-md-3 col-3 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
             <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create_item_type">
                <i class="fas fa-plus"></i>                   
                Add Table Type
            </a>
        </div>

        <div class="modal fade" id="create_item_type" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Table Type Create Form</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>

                    <div class="modal-body">
                        <form class="form-material" method="post" action="{{route('store_table_type')}}" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label">Prefix</label>
                                    <input type="text" name="prefix" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class=" col-md-9">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>           
                    </div>
                </div>
            </div>
        </div>
    </div>  

</div>

<div class="row">
    
    <div class="col-md-8">        
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Table List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Table Number</th>
                                <th>Floor</th>
                                <th>Table Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=1;?>
                            @foreach($table_lists as $table)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$table->table_number}}</td>
                                <td>{{$table->floor}}</td>
                                <td>{{$table->table_type->name}}</td>
                                <td><a href="{{route('shop_order_sale', $table->id)}}" class="btn btn-primary">Go To Shop Order Page</a></td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Table Type List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Prefix</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=1;?>
                            @foreach($table_type_lists as $type)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$type->prefix}}</td>
                                <td>{{$type->name}}</td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_item{{$type->id}}"><i class="far fa-edit"></i>
                                    Edit</a>
                                </td>
                                
                                <div class="modal fade" id="edit_item{{$type->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Table Type Form</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>

                                    <div class="modal-body">
                                        <form class="form-material" method="post" action="{{route('update_table_type', $type->id)}}">
                                            @csrf
                                            <div class="form-group">    
                                                <label class="font-weight-bold">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{$type->name}}"> 
                                            </div>
                                            <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Update">
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