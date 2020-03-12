<?php

namespace App\Http\Requests;

use App\ApprovedRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreApprovedRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('approved_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'control_number' => [
                'min:7',
                'max:7',
                'required',
                'unique:approved_requests',
            ],
            'requestors.*'   => [
                'integer',
            ],
            'requestors'     => [
                'required',
                'array',
            ],
            'items.*'        => [
                'integer',
            ],
            'items'          => [
                'required',
                'array',
            ],
            'quantity'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'date_requested' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
