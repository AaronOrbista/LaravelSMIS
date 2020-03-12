@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.itemReleaseRecord.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.item-release-records.update", [$itemReleaseRecord->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="control_number_id">{{ trans('cruds.itemReleaseRecord.fields.control_number') }}</label>
                <select class="form-control select2 {{ $errors->has('control_number') ? 'is-invalid' : '' }}" name="control_number_id" id="control_number_id" required>
                    @foreach($control_numbers as $id => $control_number)
                        <option value="{{ $id }}" {{ ($itemReleaseRecord->control_number ? $itemReleaseRecord->control_number->id : old('control_number_id')) == $id ? 'selected' : '' }}>{{ $control_number }}</option>
                    @endforeach
                </select>
                @if($errors->has('control_number_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('control_number_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReleaseRecord.fields.control_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_requested_id">{{ trans('cruds.itemReleaseRecord.fields.date_requested') }}</label>
                <select class="form-control select2 {{ $errors->has('date_requested') ? 'is-invalid' : '' }}" name="date_requested_id" id="date_requested_id" required>
                    @foreach($date_requesteds as $id => $date_requested)
                        <option value="{{ $id }}" {{ ($itemReleaseRecord->date_requested ? $itemReleaseRecord->date_requested->id : old('date_requested_id')) == $id ? 'selected' : '' }}>{{ $date_requested }}</option>
                    @endforeach
                </select>
                @if($errors->has('date_requested_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_requested_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReleaseRecord.fields.date_requested_helper') }}</span>
            </div>
            {{--
            <div class="form-group">
                <label for="received_by">{{ trans('cruds.itemReleaseRecord.fields.received_by') }}</label>
                <input class="form-control {{ $errors->has('received_by') ? 'is-invalid' : '' }}" type="text" name="received_by" id="received_by" value="{{ old('received_by', $itemReleaseRecord->received_by) }}">
                @if($errors->has('received_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReleaseRecord.fields.received_by_helper') }}</span>
            </div>
            --}}
            <div class="form-group">
                <div class="form-check {{ $errors->has('claimed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="claimed" value="0">
                    <input class="form-check-input" type="checkbox" name="claimed" id="claimed" value="1" {{ $itemReleaseRecord->claimed || old('claimed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="claimed">{{ trans('cruds.itemReleaseRecord.fields.claimed') }}</label>
                </div>
                @if($errors->has('claimed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('claimed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReleaseRecord.fields.claimed_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.item-release-records.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>



@endsection