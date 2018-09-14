<?php

namespace OpenLineEditor\Http\Requests;

use OpenLineEditor\Http\Requests\Request;

class LinhaRequest extends Request
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
            'agencia' => 'required',
            'nome_abreviado_da_linha' => 'required|string|between:3,50',
            'nome_completo_da_linha' => 'required|string|between:8,255',
        ];
    }
}
