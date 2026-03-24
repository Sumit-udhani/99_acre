<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
        'purpose_id' => 'required',
        'category_id' => 'required',
        'type_id' => 'required',
      'sub_type_id' => 'required_with:type_id|nullable|exists:property_sub_types,id',
        'location_type_id' => 'required_with:type_id|nullable|exists:property_location_types,id',
    ];
    }
    public function messages(): array
{
    return [
        'purpose_id.required' => 'Please select purpose.',
        'category_id.required' => 'Please select category.',
        'type_id.required' => 'Please select property type.',

        'sub_type_id.required_with' => 'Please select sub type.',
        'location_type_id.required_with' => 'Please select location type.',
    ];
}
}
