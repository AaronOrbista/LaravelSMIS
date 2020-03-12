<?php

namespace App\Http\Requests;

use App\Account;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAccountRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'id_number'  => [
                'min:8',
                'max:11',
                'required',
                'unique:accounts,id_number,' . request()->route('account')->id,
            ],
            'first_name' => [
                'required',
            ],
            'last_name'  => [
                'required',
            ],
            'last_name'  => [
                'required',
            ],
            'designation' => [
                'required',
            ],
            'departments.*'      => [
                'integer',
            ],
            'departments'        => [
                'required',
                'array',
            ],
        ];
    }
}
