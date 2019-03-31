<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaquinariaRequest extends FormRequest
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
            'ma_nombre'=> 'required',
            'ma_marca'=> 'required',
            //'ma_modelo'=> 'required',
            'ma_fecha_adquisicion'=> 'required',
            //'ma_distancia'=> 'required',
            'ma_fecha_mantenimiento'=> 'required'
        ];
    }
}
