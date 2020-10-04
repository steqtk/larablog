<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [
            'title' => 'required',
            'text' => 'required',
        ];
        if ($this->method() === 'POST'){
            $rules += ['post_image.*' => ['mimes:jpg,jpeg,png,gif,svg','max:2048']];
        }

        return $rules;
    }

}
