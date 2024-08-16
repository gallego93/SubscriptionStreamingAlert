<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Models\Clients;
use App\Models\Products;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class SubscriptionController extends Controller
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
            $query = Subscriptions::query();
            $query->join('clients', 'subscriptions.client_id', '=', 'clients.id')
                  ->join('products', 'subscriptions.product_id', '=', 'products.id');
            if ($search) {
                $query->where('client_id', 'like', '%' . $search . '%')
                      ->orWhere('product_id', 'like', '%' . $search . '%')
                      ->orWhere('initial_date', 'like', '%' . $search . '%')
                      ->orWhere('final_date', 'like', '%' . $search . '%')
                      ->orWhere('clients.name', 'like', '%' . $search . '%') // Ejemplo de búsqueda en tabla relacionada
                      ->orWhere('products.name', 'like', '%' . $search . '%'); // Ejemplo de búsqueda en tabla relacionada
            }
            $subscriptions = $query->paginate($perPage);
                return view('subscriptions.index', compact('subscriptions','perPage','search'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Hubo un problema al cargar las suscripcione.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client_id = Clients::all();
        $product_id = Products::all();
            return view('subscriptions.create', compact('client_id', 'product_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        try {
            $subscription = Subscriptions::create($request->all());
                return redirect()->route('subscriptions.index', $subscription->id)
                    ->with('info', 'Subscripcion ' . $subscription->name . ' guardado con éxito!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'No se pudo guardar la suscripcion.');    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $subscription = Subscriptions::find($id);
                return view('subscriptions.show', compact('subscription'));    
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripcion no encontrada.');
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Hubo un problema al mostrar la suscripcion.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $client_id = Clients::all();
            $product_id = Products::all();
            $subscription = Subscriptions::findOrFail($id);
                return view('subscriptions.edit', compact('subscription', 'client_id', 'product_id'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripcion no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Hubo un problema al cargar el formulario de edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, string $id)
    {
        try {
            $subscription = Subscriptions::findOrFail($id);
            $subscription->update($request->all());
                return redirect()->route('subscriptions.edit', $subscription->id)
                    ->with('info', 'Subscripcion ' . $subscription->name . ' guardado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripcion no encontrada.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'No se pudo actualizar la suscripcion.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subscription = Subscriptions::findOrFail($id);
            $subscription->delete();
                return back()->with('info', 'Subscripcion eliminado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripcion no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'No se pudo eliminar la suscripcion.');
        }
    }
}

