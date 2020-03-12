@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.approvedRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.approved-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $approvedRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.control_number') }}
                        </th>
                        <td>
                            {{ $approvedRequest->control_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.requestor') }}
                        </th>
                        <td>
                            @foreach($approvedRequest->requestors as $key => $requestor)
                                <span class="label label-info">{{ $requestor->id_number }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.item') }}
                        </th>
                        <td>
                            @foreach($approvedRequest->items as $key => $item)
                                <span class="label label-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.brand') }}
                        </th>
                        <td>
                            @foreach($approvedRequest->brands as $key => $brand)
                                <span class="label label-info">{{ $brand->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.quantity') }}
                        </th>
                        <td>
                            {{ $approvedRequest->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.unit') }}
                        </th>
                        <td>
                            {{ App\ApprovedRequest::UNIT_SELECT[$approvedRequest->unit] ?? '' }}
                        </td>
                    </tr>
                    {{--
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.price') }}
                        </th>
                        <td>
                            {{ $approvedRequest->price->price ?? '' }}
                        </td>
                    </tr>
                    --}}
                    <tr>
                        <th>
                            {{ trans('cruds.approvedRequest.fields.date_requested') }}
                        </th>
                        <td>
                            {{ $approvedRequest->date_requested }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.approved-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
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
            <a class="nav-link" href="#date_requested_item_release_records" role="tab" data-toggle="tab">
                {{ trans('cruds.itemReleaseRecord.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="control_number_item_release_records">
            @includeIf('admin.approvedRequests.relationships.controlNumberItemReleaseRecords', ['itemReleaseRecords' => $approvedRequest->controlNumberItemReleaseRecords])
        </div>
        <div class="tab-pane" role="tabpanel" id="date_requested_item_release_records">
            @includeIf('admin.approvedRequests.relationships.dateRequestedItemReleaseRecords', ['itemReleaseRecords' => $approvedRequest->dateRequestedItemReleaseRecords])
        </div>
    </div>
</div>

@endsection