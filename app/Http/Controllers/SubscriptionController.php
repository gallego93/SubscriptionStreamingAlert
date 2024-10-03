<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Models\Clients;
use App\Models\Products;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\IndexRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Traits\LogTrait;
use Exception;

class SubscriptionController extends Controller
{
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
                $subscriptions = Subscriptions::WithSearch($search)->paginate($perPage);
            } else {
                $subscriptions = Subscriptions::where('user_id', $user->id)
                    ->WithSearch($search)
                    ->paginate($perPage);
            }

            return view('subscriptions.index', compact('subscriptions', 'perPage', 'search'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Hubo un problema al cargar las suscripciones.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Clients::pluck('name', 'id');
        $products = Products::pluck('name', 'id');

        return view('subscriptions.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        try {
            $subscriptionData = $request->all();
            $subscriptionData['user_id'] = auth()->id();

            $subscription = Subscriptions::create($subscriptionData);

            return redirect()->route('subscriptions.index')
                ->with('info', 'Subscripción guardada con éxito!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Hubo un problema al guardar la suscripción.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $subscription = Subscriptions::findOrFail($id);

            return view('subscriptions.show', compact('subscription'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripción no encontrada.');
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Hubo un problema al mostrar la suscripción.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $clients = Clients::pluck('name', 'id');
            $products = Products::pluck('name', 'id');
            $subscription = Subscriptions::findOrFail($id);

            return view('subscriptions.edit', compact('subscription', 'clients', 'products'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripción no encontrada.');
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
            $subscription->update($request->validated());

            return redirect()->route('subscriptions.edit', $subscription->id)
                ->with('info', 'Subscripción modificada con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Suscripción no encontrada.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Hubo un problema al actualizar la suscripción.');
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
            return redirect()->route('subscriptions.index')->with('error', 'Suscripcion no encontrada.');
        } catch (Exception $e) {
            return redirect()->route('subscriptions.index')->with('error', 'Hubo un problema eliminar la suscripcion.');
        }
    }
}
