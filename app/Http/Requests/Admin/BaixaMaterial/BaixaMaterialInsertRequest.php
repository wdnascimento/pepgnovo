<?php

namespace App\Http\Requests\Admin\BaixaMaterial;

use Illuminate\Foundation\Http\FormRequest;

class BaixaMaterialInsertRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
       
        return [
            // 'preso_id' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required',
            'motivo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'preso_id.required' =>'O campo :attribute é de preenchimento obrigatório!',
            'produto_id.required' =>'O campo :attribute é de preenchimento obrigatório!',
            'quantidade.required' =>'O campo :attribute é de preenchimento obrigatório!',
            'motivo.required' =>'O campo :attribute é de preenchimento obrigatório!',
        ];
    }

    public function attributes()
    {
        return [
            'preso_id' => 'ID Preso',
            'produto_id' => 'Produto',
            'quantidade' => 'Quantidade',
            'motivo' => 'Motivo'
        ];
    }
}
