<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventFileRequest extends FormRequest
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
            'photo' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'photo' => 'Etkinlik Fotoğrafı',
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $validatedData = parent::validated($key, $default);

        if (isset($validatedData['photo'])) {
            $validatedData['photo'] = $this->file('photo');
        }

        return $validatedData;
    }
}
