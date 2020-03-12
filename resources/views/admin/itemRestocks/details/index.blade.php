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
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              
            </thead>
           
      
            <tr>
            <td>{{$item->suppliers()->first()->company_name}}</td>
            <td>{{$item->items()->first()->name}}</td>
            <td>{{$item->brands()->first()->name}}</td>
                <td>{{$item->quantity}}</td>
            <td>{{$item->status}}</td>
                <td>
                    @if($val == true)
                            Finished Transaction
                    @else
                    <a href="{{url('admin/deliver-stock',$item->id)}}">
                    <button class="btn btn-success">
                        Deliver Stock
                </button>

                @endif
                    </a>

                </td>
              </tr>
          
                {{-- @endforeach --}}
            {{-- </thead>     --}}
        </table>

        <h6> Delivered Date</h6>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ItemRestock">
            <thead>
            <tr>
                <th>Date</th>
                <th>Quantity</th>
            
                {{-- <th> Action</th> --}}
              </tr>
              
            </thead>
           
                @foreach($date as $d)
            <tr>
        
                <td>{{date('F d Y',strtotime($d->date))}}</td>
            <td>{{$d->delivered_stock}}</td>
                         </tr>
          
           @endforeach 
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
@endsection