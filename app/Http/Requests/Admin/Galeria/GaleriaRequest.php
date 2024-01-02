<?php

namespace App\Http\Requests\Admin\Galeria;

use Illuminate\Foundation\Http\FormRequest;

class GaleriaRequest extends FormRequest
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

    public function rules()
    {
        return [
            'titulo' => 'required',
            'tipo' => 'required',
            'unidade_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'titulo.required' => 'O :attribute é obrigatório',
            'tipo.required' => 'O :attribute é obrigatório',
            'unidade_id.required' => 'O :attribute é obrigatório',
        ];
    }

    public function attributes()
    {
        return [
            'titulo' => 'Título',
            'unidade_id' => 'Unidade',
            'tipo' => 'Tipo',
        ];
    }
}
