<?php

namespace App\Http\Requests;

// use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class usuarioRequest extends FormRequest
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
    public function rules($user = null): array
    {
        $roles = Role::pluck('name');
        $roles = $roles->join(',');
        // dd($roles);
        if (is_array($user)) {
            $user = $user[0];
            $id = $user->id ?? 0;
        } else
            $id = 0;
        // dd($id, $user);
        $reglas = [
            'name' => ['required', 'string', 'min:6', 'max:50'],
            'email' => ['required', 'string', 'email', 'min:10', 'max:30', "unique:users,id,except,$id"],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // Rule::unique('users', 'email')->ignore($email)],
            'is_active' => ['boolean'],
            'profile_photo_path' => ['nullable', 'image', 'max:1024'], // 'nullable|image:png,jpg,jpeg|max:1024',
            'role' => ['required', "in:{$roles}"],
        ];

        if (!$user) {
            $validation_password = [
                'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed']
            ];
            $reglas = array_merge($reglas, $validation_password);
        }

        return $reglas;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'debe ingresar un nombre',
            'name.min' => 'al menos 8 caracteres',
            'name.max' => 'máximo 50 caracteres',
        ];
    }
}
