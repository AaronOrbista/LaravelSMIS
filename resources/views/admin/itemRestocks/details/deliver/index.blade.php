@extends('layouts.admin')
@section('content')
@can('item_restock_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            {{-- <a class="btn btn-success" href="{{ route("admin.item-restocks.create") }}">
                Item Restock Details
            </a> --}}
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{-- {{ trans('cruds.itemRestock.title_singular') }} {{ trans('global.list') }} --}}
        Details 
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ItemRestock">
            <thead>
            <tr>
                <th>Supplier</th>
                <th>Item</th>
                <th>Brand</th>
                <th>Requested Stock</th>
                <th>Quantity</th>
        
                <th> Action</th>
              </tr>
              
            </thead>
           
      
            <tr>
            <td>{{$item->suppliers()->first()->company_name}}</td>
            <td>{{$item->items()->first()->name}}</td>
            <td>{{$item->brands()->first()->name}}</td>
            <td> {{$item->quantity}}</td>
                    <form action="{{url('admin/confirm')}}" method="post">@csrf
            <td>
                        <input type="text" name="quantity" class="form-control">
                        <input type="hidden" name="quantity_item" value={{$item->quantity}}>
                        <input type="hidden" name="item_id  " value={{$item->item_id}}>
                        <input type="hidden" name="item_re_id" value="{{$item->id}}">
            </td>
                <td>
                    <a href="{{url('deliver-stock',$item->id)}}">
                    <button class="btn btn-success">
                     Confirm
                </button>
                    </a>

                </td>
              </tr>
            </form>
                {{-- @endforeach --}}
            {{-- </thead>     --}}
        </table>

    </div>
</div>



@endsection
@section('scripts')
@parent
@endsection