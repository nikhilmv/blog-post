<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class EmployeeRequest extends FormRequest
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
       
        $request = [];
        if($this->method() == 'POST'){  
            $request['first_name'] = 'required|max:255';
            $request['last_name'] = 'required|max:255';
            $request['company'] = 'required';
            $request['email'] = 'unique:employees,email|required|max:50|email|regex:/^[a-zA-Z]+(.*)@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
            $request['phone'] = 'unique:employees,phone|required|regex:/^([\+\d]?(?:[\d\-\s()]*))$/|min:10|max:15';

        } else { 
            $request['first_name'] = 'required|max:255';
            $request['last_name'] = 'required|max:255';
            $request['company'] = 'required';
            $request['email'] = 'unique:employees,email,'.$this->id.'|required|max:50|email|regex:/^[a-zA-Z]+(.*)@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
            $request['phone'] = 'unique:employees,phone,'.$this->id.'|required|regex:/^([\+\d]?(?:[\d\-\s()]*))$/|min:10|max:15';

        }
       
        return $request;
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            
        ];
    }
}
