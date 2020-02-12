<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShake extends FormRequest
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

    public function messages() {
        $messages = [];
        foreach($this->request->get('ingredients') as $key => $val) {
            $messages['items.'.$key.'.required'] = 'Ingredient '.($key+1).'" can not be empty.';
        }
        return $messages;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [ 'title' => 'present|required|string', ];
        foreach($this->request->get('ingredients') as $key => $val) {
            $rules['ingredients.'.$key] = 'present|required|string';
        }
        return $rules;
    }
}
