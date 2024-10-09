<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use App\Http\Requests\IndexRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');

        $products = Products::withSearch($search)
            ->paginate($perPage);
        return view('products.index', compact('products', 'perPage', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $requestData = $request->all();
        $requestData['user_id'] = auth()->id();

        Products::create($requestData);
        return redirect()->route('products.index')
            ->with('info', 'Registro guardado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Products::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Products::findOrFail($id);
        $requestData = $request->validated();

        $product->update($requestData);
        return redirect()->route('products.edit', $product->id)
            ->with('info', 'Registro modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return back()->with('info', 'Registro eliminado con éxito.');
    }
}
