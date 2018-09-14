<?php

namespace OpenLineEditor\Http\Requests;

use OpenLineEditor\Http\Requests\Request;

class EmpresaRequest extends Request
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
            'nome_da_empresa' => 'required|unique:agencies,agency_name|string|between:6,60',
            'site_da_empresa' => 'required|url|between:6,100',
            'localizacao' => 'required',
        ];
    }
}
