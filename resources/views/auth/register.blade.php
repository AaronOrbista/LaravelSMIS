@extends('layouts.app')
@section('content')
<br>
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h3>Register Here</h3>
                    <hr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="First Name" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="middle_name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" autofocus placeholder="Middle Name" value="{{ old('middle_name', null) }}">
                        @if($errors->has('middle_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('middle_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" required autofocus placeholder="Last Name" value="{{ old('last_name', null) }}">
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label style="float:left;">{{ trans('cruds.user.fields.gender') }} :</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @foreach(App\User::GENDER_RADIO as $key => $label)
                                <div class="radio-inline {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }}>
                                    <label style="float:right;" class="radio-inline" for="gender_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                                @if($errors->has('gender'))
                                    <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                                @endif
                        <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-suitcase fa-fw"></i>
                            </span>
                        </div>
                        <select class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position" id="position">
                            <option value disabled {{ old('position', null) === null ? 'selected' : '' }}>Position</option>
                            @foreach(App\User::POSITION_RADIO as $key => $label)
                                <option value="{{ $key }}" {{ old('position', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('position'))
                            <div class="invalid-feedback">
                                {{ $errors->first('position') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.position_helper') }}</span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user-circle-o fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required placeholder="Username" value="{{ old('username', null) }}">
                        @if($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm Password">
                    </div>

                    <button class="btn btn-block btn-primary">
                        {{ trans('global.register') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection