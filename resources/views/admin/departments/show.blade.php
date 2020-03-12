@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.department.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.departments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

         <div class="row">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <table class="table table-bordered table-striped col-sm-8">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.id') }}
                        </th>
                        <td>
                            {{ $department->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.name') }}
                        </th>
                        <td>
                            {{ $department->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
        <div class="form-group col-sm-2">
            <br><p></p><br>
            <a class="btn btn-success" href="#">Assign</a>
            <a class="btn btn-default" href="{{ route('admin.departments.index') }}">
                {{ trans('global.cancel') }}
            </a>
        </div>
    </div>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.departments.index') }}">
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
            <a class="nav-link" href="#department_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.item.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="department_accounts">
            @includeIf('admin.departments.relationships.departmentAccounts', ['accounts' => $department->departmentAccounts])
        </div>
    </div>
</div>

@endsection