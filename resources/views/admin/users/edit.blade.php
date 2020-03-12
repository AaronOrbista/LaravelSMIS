@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

          <div class="row"> 
            <div class="form-group col-sm-4">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>

            <div class="form-group col-sm-4">
                <label for="middle_name">{{ trans('cruds.user.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $user->middle_name) }}">
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block"><p class="text-muted"><i>{{ trans('cruds.user.fields.middle_name_helper') }}</i></span>
            </div>

            <div class="form-group col-sm-4">
                <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
            </div>
          </div>

         <div class="row">
          <div class="form-group col-sm-4">
            <label>{{ trans('cruds.user.fields.gender') }}</label>
            @foreach(App\User::GENDER_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $user->gender) === (string) $key ? 'checked' : '' }}>
                    <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                </div>
            @endforeach
            @if($errors->has('gender'))
                <div class="invalid-feedback">
                    {{ $errors->first('gender') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
        </div>

          <div class="form-group col-sm-4">
            <label>{{ trans('cruds.user.fields.position') }}</label>
            @foreach(App\User::POSITION_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('position') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="position_{{ $key }}" name="position" value="{{ $key }}" {{ old('position', $user->position) === (string) $key ? 'checked' : '' }}>
                    <label class="form-check-label" for="position_{{ $key }}">{{ $label }}</label>
                </div>
            @endforeach
            @if($errors->has('position'))
                <div class="invalid-feedback">
                    {{ $errors->first('position') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.position_helper') }}</span>
          </div>

          <div class="form-group col-sm-4">
            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
           {{-- <div style="padding-bottom: 4px">
                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
            </div>
            --}}
            <select class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" required>
                @foreach($roles as $id => $roles)
                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                @endforeach
            </select>
            @if($errors->has('roles'))
                <div class="invalid-feedback">
                    {{ $errors->first('roles') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
          </div>
         </div>

         <div class="row">
            <div class="form-group col-sm-4">
                <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
            </div>

            <div class="form-group col-sm-4">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" >
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
         </div>
            
         <hr>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>



@endsection