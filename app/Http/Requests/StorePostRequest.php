<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 5/25/2018
 * Time: 4:58 PM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required|max:15',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Ты тупой'
        ];
    }
}
