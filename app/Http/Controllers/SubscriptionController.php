<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subscriptions;
use App\Models\Clients;
use App\Models\Products;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\IndexRequest;

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

        $subscriptions = $user->hasRole('admin')
            ? Subscriptions::WithSearch($search)->paginate($perPage)
            : Subscriptions::where('user_id', $user->id)->WithSearch($search)->paginate($perPage);
        return view('subscriptions.index', compact('subscriptions', 'perPage', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = auth()->id();

        return view('subscriptions.create', [
            'clients' => Clients::where('user_id', $userId)->pluck('name', 'id'),
            'products' => Products::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        $requestData = $request->validated();
        $requestData['user_id'] = auth()->id();
        Subscriptions::create($requestData);
        return redirect()->route('subscriptions.index')
            ->with('info', 'Registro guardado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscription = Subscriptions::findOrFail($id);
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = auth()->id();

        $subscription = Subscriptions::findOrFail($id);
        return view('subscriptions.edit', [
            'subscription' => $subscription,
            'clients' => Clients::where('user_id', $userId)->pluck('name', 'id'),
            'products' => Products::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, string $id)
    {
        $subscription = Subscriptions::findOrFail($id);
        $requestData = $request->validated();
        $requestData['status'] = $request->has('status');
        $subscription->update($requestData);
        return redirect()->route('subscriptions.edit', $subscription->id)
            ->with('info', 'Registro modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription = Subscriptions::findOrFail($id);
        $subscription->delete();
        return back()->with('info', 'Registro eliminado con éxito.');
    }
}
