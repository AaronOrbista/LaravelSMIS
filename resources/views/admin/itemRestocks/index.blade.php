@extends('layouts.admin')
@section('content')
@can('item_restock_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.item-restocks.create") }}">
                Item Restock
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.itemRestock.title_singular') }} {{ trans('global.list') }}
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
            @foreach($item as $i)
      
            <tr>
            <td>{{$i->suppliers()->first()->company_name}}</td>
            <td>{{$i->items()->first()->name}}</td>
            <td>{{$i->brands()->first()->name}}</td>
                <td>{{$i->quantity}}</td>
            <td>{{$i->status}}</td>
                <td>
                    <a href="{{url('admin/item-restocks/details',$i->id)}}">
                            <button class="btn btn-primary">
                                    Details
                            </button>
                    </a>

                

                </td>
              </tr>
          
                @endforeach
            {{-- </thead>     --}}
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
{{-- <script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('item_restock_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.item-restocks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.item-restocks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'supplier', name: 'suppliers.id' },
{ data: 'item', name: 'items.name' },
{ data: 'brand', name: 'brands.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  };
  $('.datatable-ItemRestock').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script> --}}
@endsection