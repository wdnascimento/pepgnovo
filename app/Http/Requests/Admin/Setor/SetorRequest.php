<?php

namespace App\Http\Requests\Admin\Setor;

use Illuminate\Foundation\Http\FormRequest;

class SetorRequest extends FormRequest
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
            'responsavel' => 'required',
        ];
    }

    public function messages(){
        return [
            'titulo.required' => 'O :attribute é obrigatório',
            'responsavel.required' => 'O :attribute é obrigatório'
        ];
    }

    public function attributes()
    {
        return [
            'titulo' => 'Título',
            'responsavel' => 'Responsável'
        ];
    }
}
