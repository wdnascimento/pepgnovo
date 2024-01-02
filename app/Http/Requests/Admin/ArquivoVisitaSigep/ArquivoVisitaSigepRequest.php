<?php

namespace App\Http\Requests\Admin\ArquivoVisitaSigep;

use App\Rules\Admin\ArquivoSigep\ValidarArquivoCvs;
use Illuminate\Foundation\Http\FormRequest;

class ArquivoVisitaSigepRequest extends FormRequest
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
            'file' => 'required',
            'file' => new ValidarArquivoCvs($this),
        ];
    }

    public function messages(){
        return [
            'file.required' => 'O :attribute é obrigatório',
            'file.mimes' => 'O :attribute precisa ser no formato CSV',
        ];
    }

    public function attributes()
    {
        return [
            'file' => 'Arquivo',
        ];
    }
}
