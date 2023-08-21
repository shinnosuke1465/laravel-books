<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //必須。255文字まで
            'name' => 'required|max:255',
            //必須。BOOK::BOOK_STATUS_ARRAYの値（1~4）
            'status' => ['required', Rule::in(BOOK::BOOK_STATUS_ARRAY)],
            'author' => 'max:255',
            'publication' => 'max:255',
            'note' => 'max:1000',
            'read_at' => 'nullable|date'
        ];
    }
}
