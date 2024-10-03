<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\IndexRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Traits\LogTrait;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    use LogTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');
        $user = Auth::user();

        try {
            if ($user->hasRole('admin')) {
                $clients = Clients::WithSearch($search)->paginate($perPage);
            } else {
                $clients = Clients::where('user_id', $user->id)
                    ->WithSearch($search)
                    ->paginate($perPage);
            }

            return view('clients.index', compact('clients', 'perPage', 'search'));
        } catch (Exception $e) {
            $this->logError($e);
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
            $clientData = $request->all();
            $clientData['user_id'] = auth()->id();

            $client = Clients::create($clientData);

            return redirect()->route('clients.index', $client->id)
                ->with('info', 'Cliente ' . $client->name . ' guardado con éxito!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            $this->logError($e);
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
