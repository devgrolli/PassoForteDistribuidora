<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'nome' => 'required|min:5',
            'email' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'tipo_cliente_id' => 'required',
        ];
    }

    public function messages()    {
        return [
            'nome.required' => 'Nome do cliente deve ser preenchido.',
            'email.required' => 'E-mail deve ser preenchido.',
            'telefone.required' => 'Telefone deve ser preenchido.',
        ];
    }
}
