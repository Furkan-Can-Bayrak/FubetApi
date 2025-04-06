<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'event_date' => 'required|date',
            'photo' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048',
            'location' => 'required|string|max:255',
            'published_at' => 'required|date|before_or_equal:event_date',
            'status' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Etkinlik Başlığı',
            'description' => 'Açıklama',
            'event_date' => 'Etkinlik Tarihi',
            'photo' => 'Etkinlik Fotoğrafı',
            'location' => 'Etkinlik Lokasyonu',
            'published_at' => 'Yayınlanma Tarihi',
            'status' => 'Durum',
        ];
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

        if (isset($validatedData['file'])) {
            $validatedData['file'] = $this->file('file');
        }

        return $validatedData;
    }

}
