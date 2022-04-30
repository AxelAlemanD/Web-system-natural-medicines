<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'user_id'       => 'required|numeric',
            'total_amount'  => 'required',
            'products'      => 'required|array|min:1',
            'quantities'    => 'required|array|min:1',
            'amount_paid'   => 'required ',
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required'      => 'Es necesario seleccionar un cliente',
            'total_amount.required' => 'La descripción del producto es requerido',
            'products.required'     => 'Debe incluir por lo menos un producto',
            'quantities.required'   => 'Debe incluir por lo menos un producto',
            'amount_paid.required'  => 'La cantidad pagada es requerida',
        ];
    }
}