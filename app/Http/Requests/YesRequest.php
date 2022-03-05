<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() ==  'hello')
       {
           return true;
        }  else {
           return false;
    
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'name' => 'required',
             'gender' => 'required',
             'hobby' => 'required',
        ];
    }
}
