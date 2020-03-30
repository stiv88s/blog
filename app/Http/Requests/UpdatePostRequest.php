<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'is_active'=>['integer', Rule::in([1, 0])],
            'slug'  => 'required|string',
            'title' => 'required|string',
            'subtitle'  =>'required|string',
            'body'  =>'required|string',
            'header_image'=> 'image|min:20|max:5000',
            'categorys'=>'required|array',
            'categorys.*' => 'required|integer|exists:categories,id',
            'tags'=>'required|array',
            'tags.*'=>'required|integer|exists:tags,id',
        ];
    }
}
