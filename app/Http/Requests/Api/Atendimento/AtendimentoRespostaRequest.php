<?php

namespace App\Http\Requests\Api\Atendimento;

use Illuminate\Foundation\Http\FormRequest;

class AtendimentoRespostaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'atendimento_id' => 'required',
            'url_audio_resposta' => 'required',
            'lido' => 'required',
            'respondido' => 'required',
        ];
    }

    public function messages(){
        return [
            'atendimento_id.required' => 'O :attribute é obrigatório',
            'url_audio_resposta.required' => 'O :attribute é obrigatório',
            'lido.required' => 'O :attribute é obrigatório',
            'respondido.required' => 'O :attribute é obrigatório',
        ];
    }

    public function attributes()
    {
        return [
            'atendimento_id' => 'Atendimento',
            'url_audio_resposta' => 'Áudio Resposta',
            'lido' => 'Lido',
            'respondido' => 'Respondido',
        ];
    }
}
