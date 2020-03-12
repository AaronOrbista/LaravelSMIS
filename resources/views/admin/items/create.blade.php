@extends('layouts.admin')
@section('content')



{{-- Create ITEMS --}}

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.items.store") }}" enctype="multipart/form-data">
            @csrf

           <div class="row"> 
            <div class="form-group col-sm-4">
                <label class="required" for="name">{{ trans('cruds.item.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.name_helper') }}</span>
            </div>

            <div class="form-group col-sm-4">
              <label class="required" for="brands">{{ trans('cruds.item.fields.brand') }}</label>
              <select class="form-control select2{{ $errors->has('brands') ? 'is-invalid' : '' }}" type="text" name="brands[]" id="brands" required>
                  @foreach($brands as $id => $brand)
                      <option value="{{ $id }}" {{ in_array($id, old('brands', [])) ? 'selected' : '' }}>{{ $brand }}</option>
                  @endforeach
              </select>
              @if($errors->has('brands'))
                  <div class="invalid-feedback">
                      {{ $errors->first('brands') }}
                  </div>
              @endif
              <span class="help-block">{{ trans('cruds.item.fields.brand_helper') }}</span>
          </div>

          <div class="form-group col-sm-4">
            <label>{{ trans('cruds.item.fields.item_category') }}</label>
            @foreach(App\Item::ITEM_CATEGORY_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('item_category') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="item_category_{{ $key }}" name="item_category" value="{{ $key }}" {{ old('item_category', '') === (string) $key ? 'checked' : '' }}>
                    <label style="float;right" class="form-check-label" for="item_category_{{ $key }}">{{ $label }}</label>
                </div>
            @endforeach
            @if($errors->has('item_category'))
                <div class="invalid-feedback">
                    {{ $errors->first('item_category') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.item.fields.item_category_helper') }}</span>
        </div>
      </div> 

            {{--
            <div class="form-group">
                <label for="price">{{ trans('cruds.item.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.price_helper') }}</span>
            </div>
            --}}
            
          {{--  <div class="form-group col-sm-4">
                <label class="required">{{ trans('cruds.item.fields.item_category') }}</label>
                    @foreach(App\Item::ITEM_CATEGORY_RADIO as $key => $label)
                        <option value="{{ $key }}" {{ old('item_category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('item_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.item_category_helper') }}</span>
            </div
            --}}

            <div class="row">
              <div class="form-group col-sm-2">
                <label>{{ trans('cruds.item.fields.unit') }}</label>
                <select class="form-control select2{{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit" id="unit">
                    <option value disabled {{ old('unit', null) === null ? 'selected' : '' }}>
                    @foreach(App\Item::UNIT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('unit', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.unit_helper') }}</span>
            </div>

            <div class="form-group col-sm-6">
                <label for="description">{{ trans('cruds.item.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" value="{{ old('description') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.description_helper') }}</span>
            </div>

            <div class="form-group col-sm-4">
              <label class="required" for="quantity">{{ trans('cruds.item.fields.quantity') }}</label>
              <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" step="1" required>
              @if($errors->has('quantity'))
                  <div class="invalid-feedback">
                      {{ $errors->first('quantity') }}
                  </div>
              @endif
              <span class="help-block">{{ trans('cruds.item.fields.quantity_helper') }}</span>
          </div>
        </div>

        <hr> 
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
                  {{ trans('global.cancel') }}
              </a>
            </div>
        </form>
    </div>
</div>

@endsection



@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/items/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $item->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection