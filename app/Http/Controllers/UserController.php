<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');

        $users = User::withSearch($search)
            ->paginate($perPage);
        return view('users.index', compact('users', 'perPage', 'search'));
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
        $requestData = $request->validated();

        User::create($requestData);

        return redirect()->route('users.index')
            ->with('info', 'Usuario guardado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'userRoles' => $user->roles->pluck('name')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $requestData = $request->validated();
        $requestData = $request->except('roles');

        $user->update($requestData);

        if ($request->has('roles')) {
            $user->syncRoles($request->input('roles'));
        }

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->input('password'))]);
        }

        return redirect()->route('users.edit', $user->id)
            ->with('info', 'Usuario ' . $user->name . ' guardado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('info', 'Usuario eliminado con éxito.');
    }
}
