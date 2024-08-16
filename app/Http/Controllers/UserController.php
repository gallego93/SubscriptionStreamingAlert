<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');
        if (!in_array($perPage, [5, 10, 20, 50, 100])) {
            $perPage = 20;
        }
        try {
            $query = User::query();
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            }
            $users = $query->paginate($perPage);
                return view('users.index', compact('users','perPage','search'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Hubo un problema al cargar los usuarios.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->all());
            return redirect()->route('users.index', $user->id)
                ->with('info', 'Usuario ' . $user->name . ' guardado con éxito!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se pudo guardar el usuario.');    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
                return view('users.show', compact('user'));    
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al mostrar el usuario.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::find($id);
                return view('users.edit', compact('user'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al cargar el formulario de edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id);
            $user->update($request->all());
        return redirect()->route('users.edit', $user->id)
            ->with('info', 'Usuario ' . $user->name . ' guardado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se pudo actualizar el usuario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id)->delete();
            return back()->with('info', 'Usuario eliminado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se pudo eliminar el usuario.');
        }
    }
}