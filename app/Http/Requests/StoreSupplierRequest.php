<?php

namespace App\Http\Requests;

use App\Supplier;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'company_name' => [
                'required',
            ],
            'tin_number'  => [
                'min:9',
                'max:15',
                'required',
            ],
            'contact_number'  => [
                'min:11',
                'max:14',
                'required',
            ],
            'address' => [
                'required',
            ],
        ];
    }
}
