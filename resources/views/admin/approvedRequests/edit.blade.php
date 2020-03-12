@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.approvedRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.approved-requests.update", [$approvedRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="control_number">{{ trans('cruds.approvedRequest.fields.control_number') }}</label>
                <input class="form-control {{ $errors->has('control_number') ? 'is-invalid' : '' }}" type="text" name="control_number" id="control_number" value="{{ old('control_number', $approvedRequest->control_number) }}" required>
                @if($errors->has('control_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('control_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.control_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="requestors">{{ trans('cruds.approvedRequest.fields.requestor') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('requestors') ? 'is-invalid' : '' }}" name="requestors[]" id="requestors" multiple required>
                    @foreach($requestors as $id => $requestor)
                        <option value="{{ $id }}" {{ (in_array($id, old('requestors', [])) || $approvedRequest->requestors->contains($id)) ? 'selected' : '' }}>{{ $requestor }}</option>
                    @endforeach
                </select>
                @if($errors->has('requestors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requestors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.requestor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="items">{{ trans('cruds.approvedRequest.fields.item') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('items') ? 'is-invalid' : '' }}" name="items[]" id="items" multiple required>
                    @foreach($items as $id => $item)
                        <option value="{{ $id }}" {{ (in_array($id, old('items', [])) || $approvedRequest->items->contains($id)) ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
                @if($errors->has('items'))
                    <div class="invalid-feedback">
                        {{ $errors->first('items') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.item_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brands">{{ trans('cruds.approvedRequest.fields.brand') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('brands') ? 'is-invalid' : '' }}" name="brands[]" id="brands" multiple>
                    @foreach($brands as $id => $brand)
                        <option value="{{ $id }}" {{ (in_array($id, old('brands', [])) || $approvedRequest->brands->contains($id)) ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
                @if($errors->has('brands'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brands') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.brand_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.approvedRequest.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $approvedRequest->quantity) }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.approvedRequest.fields.unit') }}</label>
                <select class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit" id="unit">
                    <option value disabled {{ old('unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ApprovedRequest::UNIT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('unit', $approvedRequest->unit) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.unit_helper') }}</span>
            </div>
            {{--
            <div class="form-group">
                <label for="price_id">{{ trans('cruds.approvedRequest.fields.price') }}</label>
                <select class="form-control select2 {{ $errors->has('price') ? 'is-invalid' : '' }}" name="price_id" id="price_id">
                    @foreach($prices as $id => $price)
                        <option value="{{ $id }}" {{ ($approvedRequest->price ? $approvedRequest->price->id : old('price_id')) == $id ? 'selected' : '' }}>{{ $price }}</option>
                    @endforeach
                </select>
                @if($errors->has('price_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.price_helper') }}</span>
            </div>
            --}}
            <div class="form-group">
                <label for="date_requested">{{ trans('cruds.approvedRequest.fields.date_requested') }}</label>
                <input class="form-control date {{ $errors->has('date_requested') ? 'is-invalid' : '' }}" type="text" name="date_requested" id="date_requested" value="{{ old('date_requested', $approvedRequest->date_requested) }}">
                @if($errors->has('date_requested'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_requested') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.date_requested_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.approved-requests.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>



@endsection