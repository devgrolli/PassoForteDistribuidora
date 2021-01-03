<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'nome' => 'required|min:5',
            'preco_un' => 'required|between:0,99.99', 
            'marca' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome do produto deve ser preenchido.',
            'preco_un.required' => 'Preço do produto deve ser preenchido.',
            'marca.required' => 'Marca deve ser preenchida.',
        ];
    }
}
