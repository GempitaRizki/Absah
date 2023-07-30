<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

        $parentId = (int) $this->get('parent_id');
        $id = (int) $this->get('id');

        if ($this->method() == 'PUT') {
            if ($parentId > 0) {
                $name = 'required|unique:categories,name,'.$id.',id,parent_id,'.$parentId;
            } else {
                $name = 'required|unique:categories,name,'.$id;
            }

            $slug = 'unique:categories,slug,'.$id;

        } else {
            $name = 'required|unique:categories,name,NULL,id,parent_id,'.$parentId;
            $slug = 'unique:categories,slug';
        }

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
