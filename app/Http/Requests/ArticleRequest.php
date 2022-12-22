<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {


        $validation = [
            'title' => 'required',
            'content' => 'required',
            'article_image' => 'mimes:jpg,png|required'
        ];

        if(request()->method == 'PATCH') {
            $validation['article_image'] = 'mimes:jpg,png';
        }

        return $validation;
    }


    public function messages()
    {
        return [
            'title.required' => 'Title field is required',
            'content.required' => 'Content field is required',
            'article_image.required' => 'Image field is required',
            'article_image.mimes' => 'Image only accept file type jpg,png'
            
        ];
    }
}
