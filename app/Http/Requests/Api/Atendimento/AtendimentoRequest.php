<?php

namespace App\Http\Requests\Api\Atendimento;

use Illuminate\Foundation\Http\FormRequest;

class AtendimentoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'preso_id' => 'required',
            'setor_id' => 'required',
            'url_audio' => 'required',
        ];
    }

    public function messages(){
        return [
            'preso_id.required' => 'O :attribute é obrigatório',
            'setor_id.required' => 'O :attribute é obrigatório',
            'url_audio.required' => 'O :attribute é obrigatório',
        ];
    }

    public function attributes()
    {
        return [
            'preso_id' => 'Preso',
            'setor_id' => 'Setor',
            'file' => 'Arquivo',
        ];
    }
}
