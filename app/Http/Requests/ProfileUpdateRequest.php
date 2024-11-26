<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Mahasiswa::class)->ignore($this->user()->id),
            ],
            'nim' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ];
    }
}
