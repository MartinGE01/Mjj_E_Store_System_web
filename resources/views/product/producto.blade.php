@extends('raiz.panel')



@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Available Products
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Unit Price</th>
                        <th>Sales Unit Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                	{{--@foreach($products as $row)--}}
                    <tr>
                        <td>product_code </td>
                        <td>name </td>
                        <td>category </td>
                        
                        {{--@if($row->stock > '0')--}}
                
                            <td>stock </td>
                            {{-- @else--}}
                            <td>Not Available</td>
                            {{--  @endif--}

                        <td>unit_price </td>
                        <td>sales_unit_price </td>
                        <td>
                        	<a href="{{ 'add-order/'.$row->id }}" class="btn btn-sm btn-info">Order</a>
                        </td>
                    </tr>
                    {{-- @endforeach--}}
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection