<?php

namespace App\Http\Requests\Admin\Recebimento;

use Illuminate\Foundation\Http\FormRequest;

class RecebimentoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        
        return [
            // 'id' => 'required'
            
        ];
    }

    public function messages()
    {
        return [

            // 'id.required' =>'O campo :attribute é de preenchimento obrigatório!'
            
        ];
    }

    public function attributes()
    {
        return [
            // 'id' => 'Credencial'
            
        ];
    }
}
