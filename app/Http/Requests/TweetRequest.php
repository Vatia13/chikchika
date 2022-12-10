<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
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
            'tweet' => ['required', 'max:140'],
            'user_id' => ['required']
        ];
    }

    /**
     * Add logged in user id in request
     */
    public function prepareForValidation()
    {
        $this->merge(['user_id' => Auth::id()]);
    }
}
