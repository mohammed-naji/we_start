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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->method());
        $rule = 'required|image|mimes:png,jpg,jpeg';
        if($this->method() == 'PUT') {
            $rule = 'nullable|image|mimes:png,jpg,jpeg';
        }
        return [
            'title' => 'required',
            'image' => $rule,
            'content' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'content.required' => 'الوصف مطلوب'
        ];
    }
}
