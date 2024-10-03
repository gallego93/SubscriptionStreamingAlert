<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Traits\LogTrait;
use Spatie\Permission\Models\Role;
use Exception;

class UserController extends Controller
{
    use LogTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');

        try {
            $users = User::withSearch($search)
                ->paginate($perPage);

            return view('users.index', compact('users', 'perPage', 'search'));
        } catch (Exception $e) {
            $this->logError($e);
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
            $roles = Role::all();
            $userRoles = $user->roles->pluck('name')->toArray();
            return view('users.edit', compact('user', 'roles', 'userRoles'));
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
            $user->update($request->except('roles'));

            // Actualizar los roles del usuario
            if ($request->has('roles')) {
                $user->syncRoles($request->input('roles'));
            }

            if ($request->filled('password')) {
                $user->update(['password' => bcrypt($request->input('password'))]);
            }

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
