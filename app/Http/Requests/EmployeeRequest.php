<?php

namespace App\Http\Requests;

class EmployeeRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'surname' => 'required|string',
            'name' => 'required|string',
            'patronymic' => 'string|nullable',
        ];
    }
}
