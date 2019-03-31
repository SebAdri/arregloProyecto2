<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
        // dd($this->all());
        return [
            'primerNombre' => 'required',
            'primerApellido' => 'required',
            'telefono' => 'required',
            'rubro_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'primerApellido.required' => 'El primer apellido es obligatorio',
        ];
    }
}
