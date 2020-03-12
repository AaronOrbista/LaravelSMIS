@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Item Request
    </div>

    <div class="card-body">
        @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
        <form method="POST" action="{{ route("admin.approved-requests.store") }}" enctype="multipart/form-data">
            @csrf

            <!-- FORM HEAD LAYOUT -->

     <div class="row">
       <div class="form-group col-sm-8">
           <div class="fh-border">  
           <div class="clearfix">
                <img class="img1" src="/img/htc-new-seal.png" alt="HTC Seal" width="95" height="95">
                <img class="img2" src="/img/iaf-anab-iso-logo.png" alt="ISO" width="115" height="85">      
                <p style="text-align:center;padding-top:10px;"> HOLY TRINITY COLLEGE OF GENERAL SANTOS CITY
                        <br>      Supply Management Office
                        <br>   <b>SUPPLY AND EQUIPMENT MINOR REQUEST FORM</b> 
                     </p>
           </div>
       </div> 
     </div> 
       
       &nbsp;&nbsp;&nbsp;&nbsp;
        <div class="vl"></div>
       &nbsp;&nbsp;&nbsp;&nbsp;
       <div class="form-group col-sm-3">
             <label class="required" for="control_number"><b>{{ trans('cruds.approvedRequest.fields.control_number') }} :</b></label>
                <input class="form-control {{ $errors->has('control_number') ? 'is-invalid' : '' }}" type="text" name="control_number" id="control_number" value="{{ old('control_number', '') }}" required>
                    @if($errors->has('control_number'))
                     <div class="invalid-feedback">
                     {{ $errors->first('control_number') }}
                    </div>
                @endif
            <span class="help-block">{{ trans('cruds.approvedRequest.fields.control_number_helper') }}</span>
            
            <label class="required" for="date_requested"><b>Date :</b></label>
            <input class="form-control date {{ $errors->has('date_requested') ? 'is-invalid' : '' }}" type="date" name="date_requested" id="date_requested" value="{{ old('date_requested') }}">
            @if($errors->has('date_requested'))
                <div class="invalid-feedback">
                    {{ $errors->first('date_requested') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.approvedRequest.fields.date_requested_helper') }}</span>
        </div> 
     </div> 

        <hr style="border:1.5px solid rgb(44, 62, 80);">
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="required" for="requestors"><b>Requested by :</b></label>
                <select class="form-control {{ $errors->has('requestors') ? 'is-invalid' : '' }}" name="requestors[]" id="requestors" required>
                    @foreach($requestors as $id => $requestor)
                        <option value="{{ $id }}" {{ in_array($id, old('requestors', [])) ? 'selected' : '' }}>{{ $requestor }}</option>
                    @endforeach
                </select>
                @if($errors->has('requestors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requestors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.requestor_helper') }}</span>
          </div>

          {{-- Department 

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
            <span class="help-block">{{ trans('cruds.approvedRequest.fields.departments_helper') }}</span>
        </div> --}}


    </div>  

        <div class="row">
        <div class="form-group col-sm-8">
            <label for="purpose"><b>{{ trans('cruds.approvedRequest.fields.purpose') }} :</b></label>
            <input class="form-control {{ $errors->has('purpose') ? 'is-invalid' : '' }}" name="purpose" id="purpose" value="{{ old('purpose') }}" >
            @if($errors->has('purpose'))
                <div class="invalid-feedback">
                    {{ $errors->first('purpose') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.approvedRequest.fields.purpose_helper') }}</span>
        </div>
        </div>


        <hr style="border:1.5px solid rgb(44, 62, 80);">

          <div class="row">
            <div class="form-group col-sm-3">
                <label class="required" for="items"><b>Item</b></label>
                <select class="form-control {{ $errors->has('items') ? 'is-invalid' : '' }}" name="items[]" id="items" required>
                    @foreach($items as $id => $item)
                        <option value="{{ $id }}" {{ in_array($id, old('items', [])) ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
                @if($errors->has('items'))
                    <div class="invalid-feedback">
                        {{ $errors->first('items') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.item_helper') }}</span>
            </div>
            
            <div class="form-group col-sm-4">
                <label class="required" for="description"><b>{{ trans('cruds.approvedRequest.fields.description') }}</b></label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.description_helper') }}</span>
            </div>
            <div class="form-group col-sm-2">
                <label for="quantity"><b>{{ trans('cruds.approvedRequest.fields.quantity') }}</b></label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.approvedRequest.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group col-sm-2">
                <label class="required" for="unit"><b>{{ trans('cruds.approvedRequest.fields.unit') }}</b></label>
                <input class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" type="text" name="unit" id="unit" value="{{ old('unit', '') }}">
                    @if($errors->has('unit'))
                     <div class="invalid-feedback">
                     {{ $errors->first('unit') }}
                    </div>
                @endif
            <span class="help-block">{{ trans('cruds.approvedRequest.fields.unit_helper') }}</span>
            </div>
          </div>  

        <hr style="border:1.5px solid rgb(44, 62, 80);">

            <div class="form-group">
                <button class="btn btn-success" type="submit">
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
