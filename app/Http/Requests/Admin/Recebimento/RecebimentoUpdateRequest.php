<?php

namespace App\Http\Requests\Admin\Recebimento;

use Illuminate\Foundation\Http\FormRequest;

class RecebimentoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
           
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function attributes()
    {
        return [
            
        ];
    }
}
