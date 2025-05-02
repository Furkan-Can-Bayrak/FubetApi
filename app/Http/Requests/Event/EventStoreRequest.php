<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends EventRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['photo'] = 'sometimes|file|mimes:jpeg,png,jpg|max:2048';
        return $rules;
    }

    public function attributes(): array
    {
        $attributes = parent::attributes();
        $attributes['photo'] = 'Etkinlik Fotoğrafı';
        return $attributes;
    }

    /**
     * Override the validated method to process data after validation.
     *
     * @param  string|array|null  $key
     * @param  mixed  $default
     * @return array
     */
    public function validated($key = null, $default = null): array
    {
        $validatedData = parent::validated($key, $default);

        if (isset($validatedData['photo'])) {
            $validatedData['photo'] = $this->file('photo');
        }

        return $validatedData;
    }
}
