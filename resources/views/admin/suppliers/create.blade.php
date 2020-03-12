@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Supplier
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suppliers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="company_name">Company Name</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.company_name_helper') }}</span>
            </div>
            <div class="row">
            <div class="form-group col-sm-4">
                <label class="required" for="tin_number">TIN Number</label>
                <input class="form-control {{ $errors->has('tin_number') ? 'is-invalid' : '' }}" name="tin_number" id="tin_number" value="{{ old('tin_number', '') }}" required>
                @if($errors->has('tin_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tin_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.tin_number_helper') }}</span>
            </div>
            <div class="form-group col-sm-8">
                <label class="required" for="contact_number">Contact Number</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" name="contact_number" id="contact_number" value="{{ old('contact_number', '') }}" required>
                @if($errors->has('contact_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.contact_number_helper') }}</span>
            </div>
        </div>
        <div class="form-group">
            <label class="required" for="address">Address</label>
            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
            @if($errors->has('address'))
                <div class="invalid-feedback">
                    {{ $errors->first('address') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.supplier.fields.address_helper') }}</span>
        </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>


@endsection