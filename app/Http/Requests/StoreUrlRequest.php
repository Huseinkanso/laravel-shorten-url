<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'original_url'=>'required|url',
            'title'=>'required|string'
        ];
    }

    public function messages() : array
    {
        return [
            'original_url.required'=>'original url must be required',
            'original_url.url'=>'original url must be a valid url',
            'title.required'=>'title must be required',
            'title.string'=>'title must be string',

        ];
    }
}
