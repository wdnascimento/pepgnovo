<?php

namespace App\Http\Requests\Admin\Preso;

use Illuminate\Foundation\Http\FormRequest;

class PresoFotoRequest extends FormRequest
{
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
            'preso_id' => 'required',
            'url_foto' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        ];
    }

    public function messages(){
        return [
            'preso_id' => 'O :attribute é obrigatório',
            'url_foto.required' => 'O :attribute é obrigatório',
            'url_foto.mimes' => 'O :attribute precisa ser no formato jpeg,jpg,png ou gif',
            'url_foto.max' => 'O :attribute precisa ter o tamanho máximo de 10 Mb',
        ];
    }

    public function attributes()
    {
        return [
            'preso_id' => 'Preso',
            'url_foto' => 'Arquivo',
        ];
    }
}
