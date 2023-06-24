<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternalUserUpdateRequest extends FormRequest
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
        $id = \Request::segments()[2];
        return [
            'name' => 'required|max:50|min:3',
            'email' => 'required|unique:users,email,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'status' => 'required',


        ];
    }
}
