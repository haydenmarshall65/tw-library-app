<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageBooksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('librarian');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'publisher' => 'required|string',
            'publication_date' => 'required|string',
            'category' => 'required|string',
            'isbn' => 'required|numeric',
            'page_count' => 'required|numeric',
            'new_cover_image' => 'nullable|file|extensions:jpg,png'
        ];
    }
}
