<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosRequest extends FormRequest
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
            'nombre'=>'required|unique:products,name',
            'categoria'=>'required',
            'precio'=>'required|min:1|max:99999999',
            'ingredientes'=>'required',
            'descripcion'=>'required',
            'portada'=>'required|dimensions:min_width=200,min_height=200,max_width=800,max_height=800|mimes:jpeg,bmp,png',
        ];
    }
}
