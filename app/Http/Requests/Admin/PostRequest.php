<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class PostRequest extends FormRequest
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
            $request['name'] = 'required|max:255';
            $request['author'] = 'required';
            $request['date'] = 'required';
            $request['content'] = 'required';

        } else {
            $request['name'] = 'required|max:255';
            $request['author'] = 'required';
            $request['date'] = 'required';
            $request['content'] = 'required';
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
