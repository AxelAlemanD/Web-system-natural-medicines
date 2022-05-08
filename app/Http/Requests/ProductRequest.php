<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'description'   => 'required|string|max:255',
            'url_image'     => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'price'         => ['required ', 'regex:/^(?:[1-9]\d+|\d)(?:\.\d?\d)?$/m'],
            'quantity'      => 'required|numeric|min:0',
            'categories'    => "required|array|min:1",
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
            'name.required'         => 'El nombre del producto es requerido',
            'description.required'  => 'La descripción del producto es requerido',
            'url_image.required'    => 'Es necesario incluir una foto del producto',
            'price.required'        => 'El precio del producto es requerido',
            'quantity.required'     => 'La cantidad del producto es requerida',
            'categories.required'   => 'Es necesario agregar al menos una categoría',
        ];
    }
}
