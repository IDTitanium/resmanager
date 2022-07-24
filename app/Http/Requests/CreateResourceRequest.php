<?php

namespace App\Http\Requests;

use App\Models\ResourceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateResourceRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in([ResourceType::DOCUMENT,
            ResourceType::LINK, ResourceType::SNIPPET])],
            'file' => ['file','mimes:pdf', Rule::requiredif(function() {
                return request()->type === ResourceType::DOCUMENT;
            })],
            'value' => ['string', Rule::requiredif(function() {
                return request()->type === ResourceType::LINK;
            })],
            'value_tab' => ['string', Rule::requiredif(function() {
                return request()->type === ResourceType::LINK;
            })],
            'description' => 'string|nullable',
            'snippet' => [Rule::requiredif(function() {
                return request()->type === ResourceType::SNIPPET;
            })]
        ];
    }
}
