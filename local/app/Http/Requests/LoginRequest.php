<?php

namespace OpenLineEditor\Http\Requests;

use OpenLineEditor\Http\Requests\Request;

class LoginRequest extends Request
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
            'e-mail' => 'required|email',
            'senha' => 'required|alpha_num|between:6,60',
        ];
    }
}
