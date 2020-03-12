<?php

namespace App\Http\Requests;

use App\ApprovedRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyApprovedRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('approved_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:approved_requests,id',
        ];
    }
}
