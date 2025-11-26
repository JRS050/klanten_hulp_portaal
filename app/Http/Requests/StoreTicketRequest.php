<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class StoreTicketRequest extends BaseFormRequest
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
            'title' => 'required|string',
            'body' => 'required|string',
            'status' => 'required',
            'assigned_to' => 'nullable|integer',
            'category_id' => 'required|integer',
        ];
    }
}
