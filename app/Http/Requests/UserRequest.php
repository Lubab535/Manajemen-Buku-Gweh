<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Catatan: Hanya Admin yang dapat membuka CRUD akun melalui middleware role.
        return $this->user()?->hasRole('Admin') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'.($userId ? ','.$userId : '')],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:Admin,Dosen,Mahasiswa'],
        ];
    }
}
