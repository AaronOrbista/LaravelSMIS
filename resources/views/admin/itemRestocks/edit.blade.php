@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Details
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.item-restocks.update") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="requestors">{{ trans('cruds.approvedRequest.fields.requestor') }}</label>
                <div style="padding-bottom: 4px">
                </div>
                <select class="form-control select2 {{ $errors->has('suppliers') ? 'is-invalid' : '' }}" name="suppliers[]" id="suppliers" required>
                    @foreach($suppliers as $id => $supplier)
                        <option value="{{ $id }}" {{ (in_array($id, old('suppliers', [])) || $itemRestock->suppliers->contains($id)) ? 'selected' : '' }}>{{ $supplier }}</option>
                    @endforeach
                </select>
                @if($errors->has('suppliers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('suppliers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemRestock.fields.supplier_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="items">{{ trans('cruds.itemRestock.fields.item') }}</label>
                <div style="padding-bottom: 4px">
                </div>
                <select class="form-control select2 {{ $errors->has('items') ? 'is-invalid' : '' }}" name="items[]" id="items" multiple required>
                    @foreach($items as $id => $item)
                        <option value="{{ $id }}" {{ (in_array($id, old('items', [])) || $itemRestock->items->contains($id)) ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
                @if($errors->has('items'))
                    <div class="invalid-feedback">
                        {{ $errors->first('items') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemRestock.fields.item_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="brands">{{ trans('cruds.itemRestock.fields.brand') }}</label>
                <select class="form-control select2 {{ $errors->has('brands') ? 'is-invalid' : '' }}" name="brands[]" id="brands" required>
                    @foreach($brands as $id => $brand)
                        <option value="{{ $id }}" {{ (in_array($id, old('brands', [])) || $itemRestock->brands->contains($id)) ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
                @if($errors->has('brands'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brands') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemRestock.fields.brand_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="quantity">{{ trans('cruds.itemRestock.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $itemRestock->quantity) }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemRestock.fields.quantity_helper') }}</span>
            </div>

            <div class="form-group">
                <label>{{ trans('cruds.itemRestock.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ItemRestock::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $itemRestock->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemRestock.fields.status_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.item-restocks.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
            
        </form>
    </div>
</div>


@endsection