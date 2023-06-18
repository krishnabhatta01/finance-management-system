<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'id' => 'nullable|exists:users,id',
            "name"=>"required",
            "role"=>"required",
            "email"=>"required|email|unique:users,email",
            "avatar"=>"nullable|string",
        ];
        if($this->id){
            $rules["email"] = "required|email|unique:users,email,".$this->id;
        }else{
            $rules["password"] = "required|min:6";
        }
        return $rules;
    }
}
