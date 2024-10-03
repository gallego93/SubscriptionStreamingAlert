<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\IndexRequest;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');

        try {
            $products = Products::withSearch($search)
                ->paginate($perPage);

            return view('products.index', compact('products', 'perPage', 'search'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Hubo un problema al cargar los registros.');
        }
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
        try {
            $productData = $request->all();
            $productData['user_id'] = auth()->id();

            $product = Products::create($productData);

            return redirect()->route('products.index', $product->id)
                ->with('info', 'Registro ' . $product->name . ' guardado con éxito!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'No se pudo guardar el registro.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Products::find($id);
            return view('products.show', compact('product'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('clients.index')->with('error', 'Registro no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('clients.index')->with('error', 'Hubo un problema al mostrar el registro.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $product = Products::find($id);
            return view('products.edit', compact('product'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('products.index')->with('error', 'Registro no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Hubo un problema al cargar el formulario de edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Products::find($id);
            $product->update($request->all());
            return redirect()->route('products.edit', $product->id)
                ->with('info', 'registro ' . $product->name . ' guardado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('products.index')->with('error', 'Registro no encontrado.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'No se pudo actualizar el registro.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Products::find($id)->delete();
            return back()->with('info', 'Registro eliminado con éxito.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('products.index')->with('error', 'Registro no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }
}
