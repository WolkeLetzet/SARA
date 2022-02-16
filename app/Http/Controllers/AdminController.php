<?php

namespace App\Http\Controllers;
use Illuminate\Container\Container;
use Faker\Generator;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Exception;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function showAllUsers()
    {
        return view('user.admin.showAll')->with('users', User::all());
    }
    public function crearUsuario($flag = false)
    {
        $faker = Container::getInstance()->make(Generator::class);

        return view('user.admin.create')->with('roles', Role::all('id', 'name'))->with('example', $faker);
    }

    public function storeUsuario(Request $req)
    {
        $this->userRegValidator($req->all())->validate();

        try {

            $user = User::create([
                'name' => $req->get('name'),
                'email' => $req->get('email'),
                'password' => Hash::make($req->get('password')),
            ]);
            if ($req->roles) {
                $user->syncRoles($req->roles);
            } else {
                $user->assignRole('user');
            }


            return redirect(route('create-user'))->with("success", "Usuario Creado Exitosamente");
        } catch (Exception $e) {
            return view('error.show', $e->getMessage());
        }
    }

    public function editRoles()
    {
        return view('user.admin.roles.edit')->with('users', User::all())
            ->with('roles', Role::get('name'));
    }

    public function updateRoles(Request $req)
    {
        $roles = $req->roles;
        $users = User::all();

        foreach ($users as $user) {

            if (array_key_exists($user->email, $roles)) {
                $user->syncRoles($roles[$user->email]);
            } else {
                $user->syncRoles([]);
            }
        }
        return redirect(route('admin.show.all'))->with('success', 'Cambios Hechos con Exito');
    }
    public function userRegValidator($data)
    {
        return Validator::make($data, [
            "name" => 'required|string|max:255',
            "email" => 'required|string|email|max:255|unique:users',
            "password" => ['required', 'string', 'min:8', 'confirmed']

        ], [
            "required" => "Este campo es obligatorio",
            "min" => "La contraseña debe medir almenos :min caracteres",
            "confirmed" => "Las contraseñas no coinciden",
            "unique" => "Este :attribute ya esta en uso",
        ]);
    }

}
