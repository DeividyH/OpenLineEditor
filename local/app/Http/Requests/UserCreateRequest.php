<?php

namespace OpenLineEditor\Http\Requests;

use OpenLineEditor\Http\Requests\Request;

class UserCreateRequest extends Request
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
            'nome' => 'required|unique:users,name|alpha|between:3,60',
            'e-mail' => 'required|unique:users,email|email',
            'senha' => 'required|alpha_num|between:6,60',
            'confirmar_senha' => 'required|same:senha|alpha_num|between:6,60',
        ];
    }
}
