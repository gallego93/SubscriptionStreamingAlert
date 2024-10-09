<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\IndexRequest;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');
        $user = Auth::user();

        $clients = $user->hasRole('admin')
            ? Clients::WithSearch($search)->paginate($perPage)
            : Clients::where('user_id', $user->id)->WithSearch($search)->paginate($perPage);

        return view('clients.index', compact('clients', 'perPage', 'search'));
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
        $requestData = $request->validated();
        $requestData['user_id'] = auth()->id();

        Clients::create($requestData);
        return redirect()->route('clients.index')
            ->with('info', 'Registro guardado con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Clients::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Clients::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $client = Clients::findOrFail($id);
        $requestData = $request->validated();
        $requestData['email_send'] = $request->has('email_send');
        $requestData['whatsapp_send'] = $request->has('whatsapp_send');

        $client->update($requestData);

        return redirect()->route('clients.edit', $client->id)
            ->with('info', 'Cliente ' . $client->name . ' actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Clients::findOrFail($id);
        $client->delete();
        return back()->with('info', 'Cliente eliminado con éxito.');
    }
}
