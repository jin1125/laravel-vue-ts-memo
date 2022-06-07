<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemoRequest extends FormRequest
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
        $statusValue = ['incomplete' ,'working' ,'complete'];

        return [
            'title'   => 'required|max:20',
            'status'  => [
                'required',
                Rule::in($statusValue)
            ],
            'detail'  => 'required|max:100',
            'limit'   => 'required|date_format:Y-m-d',
        ];
    }
}
