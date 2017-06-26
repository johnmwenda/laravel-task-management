<?php

namespace App\Http\Requests\Api;

// use Illuminate\Foundation\Http\FormRequest;

class LoginUser extends ApiRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        // error_log(print_r($this->get('user'), true));
        return $this->get('user') ?: [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
    }
} 
