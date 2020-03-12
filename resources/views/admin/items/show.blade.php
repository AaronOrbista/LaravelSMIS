@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.item.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.id') }}
                        </th>
                        <td>
                            {{ $item->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.name') }}
                        </th>
                        <td>
                            {{ $item->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.quantity') }}
                        </th>
                        <td>
                            {{ $item->quantity }}
                        </td>
                    </tr>
                    {{--
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.price') }}
                        </th>
                        <td>
                            {{ $item->price }}
                        </td>
                    </tr>
                    --}}
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.brand') }}
                        </th>
                        <td>
                            @foreach($item->brands as $key => $brand)
                                <span class="label label-info">{{ $brand->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.item_category') }}
                        </th>
                        <td>
                            {{ App\Item::ITEM_CATEGORY_RADIO[$item->item_category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.description') }}
                        </th>
                        <td>
                            {!! $item->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
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
        {{--
        <li class="nav-item">
            <a class="nav-link" href="#price_approved_requests" role="tab" data-toggle="tab">
                {{ trans('cruds.approvedRequest.title') }}
            </a>
        </li>
        --}}
        <li class="nav-item">
            <a class="nav-link" href="#item_approved_requests" role="tab" data-toggle="tab">
                {{ trans('cruds.approvedRequest.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        {{--
        <div class="tab-pane" role="tabpanel" id="price_approved_requests">
            @includeIf('admin.items.relationships.priceApprovedRequests', ['approvedRequests' => $item->priceApprovedRequests])
        </div>
        --}}
        <div class="tab-pane" role="tabpanel" id="item_approved_requests">
            @includeIf('admin.items.relationships.itemApprovedRequests', ['approvedRequests' => $item->itemApprovedRequests])
        </div>
    </div>
</div>

@endsection