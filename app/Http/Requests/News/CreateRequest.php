<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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

        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'news_source_id' => ['nullable','integer', 'exists:news_sources,id'],
            'title' => ['required', 'min:3', 'max:100', 'string'],
            'text' => ['required', 'min:3', 'string'],
            'is_private' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'заголовок',
            'category_id' => 'категория',
            'news_source_id' => 'источник новостей',
        ];
    }
    public function messages()
    {
        return [
            'min' =>['string' => 'не меньше :min ']
        ];
    }
}
