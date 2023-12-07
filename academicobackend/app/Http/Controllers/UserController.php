<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs['password'] = Hash::make(trim($request->password));
        $usuario = User::create($inputs);
        return response()->json([
            'data' => $usuario,
            'mensaje' => "Usuario Registrado con Exito",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);
        if (isset($usuario)) {
            return response()->json([
                'data' => $usuario,
                'mensaje' => "Encontrado",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No Existe",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::find($id);
        if (isset($usuario)) {
            $usuario->first_name = $request->first_name;
            $usuario->last_name = $request->last_name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            if ($usuario->save()) {
                return response()->json([
                    'data' => $usuario,
                    'mensaje' => "Actualizado Con Exito",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No Se Actualizo",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No Existe el Estudiante.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::find($id);
        if (isset($usuario)) {
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $usuario,
                    'mensaje' => "User Eliminado",
                ]);
            } else {
                return response()->json([
                    'data' => [],
                    'mensaje' => "Existe",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No Existe",
            ]);
        }
    }
}
