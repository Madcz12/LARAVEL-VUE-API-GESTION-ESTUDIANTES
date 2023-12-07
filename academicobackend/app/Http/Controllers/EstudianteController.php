<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $estudiante = Estudiante::create($inputs);
        return response()->json([
            'data' => $estudiante,
            'mensaje' => "Estudiante Registrado Con Exito",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estudiante = Estudiante::find($id);
        if (isset($estudiante)) {
            return response()->json([
                'data' => $estudiante,
                'mensaje' => "Estudiante Encontrado",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No Existe el Estudiante",
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);
        if (isset($estudiante)) {
            $estudiante->nombre = $request->nombre;
            $estudiante->apellido = $request->apellido;
            $estudiante->foto = $request->foto;
            if ($estudiante->save()) {
                return response()->json([
                    'data' => $estudiante,
                    'mensaje' => "Estudiante Actualizado Con Exito",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No Se Actualizo el Estudiante",
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
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        if (isset($estudiante)) {
            $res = Estudiante::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $estudiante,
                    'mensaje' => "Estudiante Eliminado",
                ]);
            } else {
                return response()->json([
                    'data' => [],
                    'mensaje' => "Estudiante No Existe",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No Existe el Estudiante",
            ]);
        }
    }
}
