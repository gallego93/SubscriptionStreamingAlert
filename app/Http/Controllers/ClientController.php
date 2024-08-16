<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Http\Requests\ClientRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class ClientController extends Controller
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
            $query = Clients::query();
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('address', 'like', '%' . $search . '%')
                      ->orWhere('phone', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            }
            $clients = $query->paginate($perPage);
                return view('clients.index', compact('clients','perPage','search'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Hubo un problema al cargar los clientes.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        try {
            $client = Clients::create($request->all());
                return redirect()->route('clients.index', $client->id)
                    ->with('info', 'Cliente ' . $client->name . ' guardado con éxito!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('clients.index')->with('error', 'No se pudo guardar el cliente.');    
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $client = Clients::findOrFail($id);
                return view('clients.show', compact('client'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('clients.index')->with('error', 'Cliente no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('clients.index')->with('error', 'Hubo un problema al mostrar el cliente.');
        }  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $client = Clients::findOrFail($id);
                return view('clients.edit', compact('client'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('clients.index')->with('error', 'Cliente no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('clients.index')->with('error', 'Hubo un problema al cargar el formulario de edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        try { 
        $client = Clients::findOrFail($id);
        $client->update($request->all());
            return redirect()->route('clients.edit', $client->id)
                ->with('info', 'Cliente ' . $client->name . ' actualizado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('clients.index')->with('error', 'Cliente no encontrado.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('clients.index')->with('error', 'No se pudo actualizar el cliente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client = Clients::findOrFail($id);
            $client->delete();
                return back()->with('info', 'Cliente eliminado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('clients.index')->with('error', 'Cliente no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('clients.index')->with('error', 'No se pudo eliminar el cliente.');
        }
    }
}
