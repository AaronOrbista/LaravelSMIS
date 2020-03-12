@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.itemRestock.title') }} Details
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-restocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.itemRestock.fields.id') }}
                        </th>
                        <td>
                            {{ $itemRestock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemRestock.fields.supplier') }}
                        </th>
                        <td>
                            @foreach($itemRestock->suppliers as $key => $supplier)
                                <span class="label label-info">{{ $supplier->id }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemRestock.fields.item') }}
                        </th>
                        <td>
                            @foreach($itemRestock->items as $key => $item)
                                <span class="label label-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemRestock.fields.brand') }}
                        </th>
                        <td>
                            @foreach($itemRestock->brands as $key => $brand)
                                <span class="label label-info">{{ $brand->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemRestock.fields.quantity') }}
                        </th>
                        <td>
                            {{ $itemRestock->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemRestock.fields.status') }}
                        </th>
                        <td>
                            {{ App\ItemRestock::STATUS_SELECT[$itemRestock->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-restocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!--<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#control_number_item_release_records" role="tab" data-toggle="tab">
                {{ trans('cruds.itemReleaseRecord.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#date_issued_item_release_records" role="tab" data-toggle="tab">
                {{ trans('cruds.itemReleaseRecord.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="control_number_item_release_records">
            @includeIf('admin.approvedRequests.relationships.controlNumberItemReleaseRecords', ['itemReleaseRecords' => $approvedRequest->controlNumberItemReleaseRecords])
        </div>
        <div class="tab-pane" role="tabpanel" id="date_issued_item_release_records">
            @includeIf('admin.approvedRequests.relationships.dateIssuedItemReleaseRecords', ['itemReleaseRecords' => $approvedRequest->dateIssuedItemReleaseRecords])
        </div>
    </div>
</div>
-->
@endsection