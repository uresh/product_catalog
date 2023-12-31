<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|max:12|alpha_num:ascii',
            'category' => 'required|max:40',
            'name' => 'required',
            'description' => 'max:400',
            'selling_price' => 'required',
            'special_price' => 'required',
            'status' => 'required',
            // 'is_delivery_available' => 'required',
            'image' => [ File::types(['jpeg', 'png'])->max('2mb')],
        ];
    }
}
