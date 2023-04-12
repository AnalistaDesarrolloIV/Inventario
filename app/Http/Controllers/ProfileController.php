<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit($id)
    {
        if ($id == Auth::user()->id) {
            $usuario = User::find($id);
            $roles = DB::select('select * from Roles');
            $roles = json_decode( json_encode( $roles),true);
    
            return view('pages.perfil.Perfil', compact('usuario', 'roles'));
        }else {
             
            Alert::warning('Advertencia', 'No puedes editar un perfil diferente al tuyo.');
            return redirect()->route('home');
        }
    }

    
    public function update(ProfileRequest $request, $id)
    {
        $inputs = $request->all();
        
        $usuario = User::find($id);

        $usuario->update([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'Rol_id' => $inputs['rol'],
        ]);
        Alert::success('Perfil', 'Perfil personal actualizado exitosamente.');
        return redirect()->route('edit', $id);

    }

    public function updatePass(ChangePasswordRequest $request, $id)
    {
        $inputs = $request->all();

        $user = User::find($id);
        $user->update([
            'password' => Hash::make($inputs['newPassword']),
        ]);

        Alert::success('Contraseña', 'Contraseña cambiada exitosamente');
        return redirect()->route('edit', $id);

    }
}
