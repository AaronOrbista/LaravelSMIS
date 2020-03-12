<?php

namespace App\Http\Requests;

use App\ItemRestock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreItemRestockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('item_restock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'suppliers.*'   => [
                'integer',
            ],
            'suppliers'     => [
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
            'brands.*'       => [
                'integer',
            ],
            'brands'         => [
                'array',
            ],
            'quantity'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
