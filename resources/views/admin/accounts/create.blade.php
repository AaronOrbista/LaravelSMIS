@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Requestor
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accounts.store") }}" enctype="multipart/form-data">
            @csrf

          <div class="row"> 
            <div class="form-group col-sm-4">
                <label class="required" for="id_number">{{ trans('cruds.account.fields.id_number') }}</label>
                <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', '') }}" required>
                @if($errors->has('id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.id_number_helper') }}</span>
            </div>
            <div class="form-group col-sm-4">
                <label class="required" for="designation">{{ trans('cruds.account.fields.designation') }}</label>
                <input class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}" type="text" name="designation" id="designation" value="{{ old('designation', '') }}" required>
                @if($errors->has('designation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('designation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.designation_helper') }}</span>
            </div>         
            <div class="form-group col-sm-4">
                <label class="required" for="departments">Department :</label>
                <select class="form-control {{ $errors->has('departments') ? 'is-invalid' : '' }}" name="departments[]" id="departments" required>
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ in_array($id, old('departments', [])) ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('departments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('departments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.department_helper') }}</span>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-4">
                <label class="required" for="first_name">{{ trans('cruds.account.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.first_name_helper') }}</span>
            </div>

            <div class="form-group col-sm-4">
                <label for="middle_name">{{ trans('cruds.account.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.middle_name_helper') }}</span>
            </div>

            <div class="form-group col-sm-4">
                <label class="required" for="last_name">{{ trans('cruds.account.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.last_name_helper') }}</span>
            </div>
          </div> 

          <hr>
          
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.accounts.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>



@endsection