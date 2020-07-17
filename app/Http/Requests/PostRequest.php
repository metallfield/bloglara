<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostRequest
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $content
 */
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
        return [
            'name' => ['required', 'string','min:3'],
            'content' => ['required', 'string', 'min:10'],
            'tags' => ['nullable', 'string'],
            'image' => ['nullable', 'image']
        ];
    }
}
