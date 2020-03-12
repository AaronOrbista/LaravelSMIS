@extends('layouts.admin')
@section('content')
@can('item_release_record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.item-release-records.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.itemReleaseRecord.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.itemReleaseRecord.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ItemReleaseRecord">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.itemReleaseRecord.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.itemReleaseRecord.fields.control_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.itemReleaseRecord.fields.date_requested') }}
                    </th>
                    {{--
                    <th>
                        {{ trans('cruds.approvedRequest.fields.date_requested') }}
                    </th>
                    
                    <th>
                        {{ trans('cruds.itemReleaseRecord.fields.received_by') }}
                    </th>
                    --}}
                    <th>
                        {{ trans('cruds.itemReleaseRecord.fields.claimed') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('item_release_record_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.item-release-records.massDestroy') }}",
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
    ajax: "{{ route('admin.item-release-records.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'control_number_control_number', name: 'control_number.control_number' },
{ data: 'date_requested_date_requested', name: 'date_requested.date_requested' },
/*
{ data: 'date_issued.date_requested', name: 'date_issued.date_requested' },
{ data: 'received_by', name: 'received_by' },
*/
{ data: 'claimed', name: 'claimed' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-ItemReleaseRecord').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection