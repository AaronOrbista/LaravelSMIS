<?php

namespace App\Http\Requests;

use App\ItemReleaseRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyItemReleaseRecordRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('item_release_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:item_release_records,id',
        ];
    }
}
