<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100', 'unique:users'],
            'nameSAP' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 
                Password::min(5)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()        
            ],
            'Rol_id' => ['required'],
        ];
    }
    
    public function attributes()
    {
        return [
            'name'=> ' Nombre ',
            'nameSAP' => ' Nombre SAP ',
            'email'=> ' Correo ',
            'password'=> ' Contraseña ',
            'Rol_id'=> ' Rol ',
        ];
    }
}
