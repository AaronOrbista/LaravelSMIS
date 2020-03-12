@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.itemReleaseRecord.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-release-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReleaseRecord.fields.id') }}
                        </th>
                        <td>
                            {{ $itemReleaseRecord->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReleaseRecord.fields.control_number') }}
                        </th>
                        <td>
                            {{ $itemReleaseRecord->control_number->control_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReleaseRecord.fields.date_requested') }}
                        </th>
                        <td>
                            {{ $itemReleaseRecord->date_requested->date_requested ?? '' }}
                        </td>
                    </tr>
                    {{--
                    <tr>
                        <th>
                            {{ trans('cruds.itemReleaseRecord.fields.received_by') }}
                        </th>
                        <td>
                            {{ $itemReleaseRecord->received_by }}
                        </td>
                    </tr>
                    --}}
                    <tr>
                        <th>
                            {{ trans('cruds.itemReleaseRecord.fields.claimed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $itemReleaseRecord->claimed ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-release-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection