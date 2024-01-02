<?php

namespace App\Http\Requests\Admin\Produto;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
    // ["descricao","categoria","unidade_medida","controlado_almox","observacao"]
    public function rules()
    {
        return [
            'descricao' => 'required',
            'controlado_almox' => 'required'           
        ];
    }
    
    public function messages(){
        return [
            'descricao.required' => 'O campo :attribute é de preenchimento obrigatório',
            'controlado_almox.required' => 'A :attribute é obrigatório'
            ];
    }

    public function attributes()
    {
        return [
            'descricao' => 'Descrição',
            'controlado_almox' => 'Controlado'
            ];
    }
}
