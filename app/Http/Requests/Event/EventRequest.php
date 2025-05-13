<?php

namespace App\Http\Requests\Event;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'category_id' => 'required|string|size:24',
            'description' => 'nullable|string|max:5000',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'published_at' => 'required|date|before_or_equal:event_date',
            'status' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Etkinlik Başlığı',
            'category_id' => 'Kategori',
            'description' => 'Açıklama',
            'event_date' => 'Etkinlik Tarihi',
            'location' => 'Etkinlik Lokasyonu',
            'published_at' => 'Yayınlanma Tarihi',
            'status' => 'Durum',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $categoryId = $this->input('category_id');

            if (!Category::where('_id', $categoryId)->exists()) {
                $validator->errors()->add('category_id', 'Seçilen kategori mevcut değil.');
            }
        });
    }

}
