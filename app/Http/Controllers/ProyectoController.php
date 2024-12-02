<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // Muestra la lista de proyectos
    public function index()
    {
        $proyectos = Proyecto::all();
        $estados = Estado::all();
        $users = User::all(); // O puedes filtrar los usuarios si es necesario

        return view('proyectos.index', compact('proyectos', 'estados', 'users'));
    }

    // Guarda un nuevo proyecto
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre_proyecto' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'estado_id' => 'required|exists:estados,id',
        'fecha_inicio' => 'required|date',
        'fecha_termino' => 'required|date',
        'user_id' => 'required|exists:users,id',
        'imagen' => 'nullable|image|max:2048', // Validar imagen (si se sube)
    ]);

    // Crear el proyecto
    $proyecto = new Proyecto();
    $proyecto->nombre_proyecto = $request->nombre_proyecto;
    $proyecto->descripcion = $request->descripcion;
    $proyecto->esatdo_id = $request->estado_id;
    $proyecto->fecha_inicio = $request->fecha_inicio;
    $proyecto->fecha_termino = $request->fecha_termino;
    $proyecto->user_id = $request->user_id;

    // Manejar la carga de la imagen (si se ha subido una imagen)
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('imagenes_proyectos', 'public');
        $proyecto->imagen = $imagenPath;
    }

    $proyecto->save();

    return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente');
}


    // Actualiza un proyecto existente
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'nombre_proyecto' => 'required|unique:proyectos,nombre_proyecto,' . $id . ',id_proyecto',
            'descripcion' => 'required',
            'estado_id' => 'required|exists:estados,id_estado',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after_or_equal:fecha_inicio',
            'user_id' => 'required|exists:users,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación de imagen
        ]);

        // Buscar el proyecto
        $proyecto = Proyecto::findOrFail($id);

        // Si hay una nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($proyecto->imagen && file_exists(storage_path('app/public/' . $proyecto->imagen))) {
                unlink(storage_path('app/public/' . $proyecto->imagen));
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('imagen')->store('images/proyectos', 'public');
            $validatedData['imagen'] = $imagePath;
        }

        // Actualizar proyecto en la base de datos
        $proyecto->update($validatedData);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente');
    }

    // Elimina un proyecto
    public function destroy($id)
    {
        // Buscar el proyecto
        $proyecto = Proyecto::findOrFail($id);

        // Eliminar imagen si existe
        if ($proyecto->imagen && file_exists(storage_path('app/public/' . $proyecto->imagen))) {
            unlink(storage_path('app/public/' . $proyecto->imagen));
        }

        // Eliminar proyecto de la base de datos
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente');
    }
}
