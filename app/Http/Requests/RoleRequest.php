<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            "name"=>"required|min:4",
        ];
        if($this->request->has('id')){
            $rules["id"]="required|exists:roles,id";
        }
        return $rules;
    }
}
