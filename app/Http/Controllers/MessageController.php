<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $messages = Message::paginate();

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create($request->all());
        return redirect()->route('messages.index', $message->id)
            ->with('info', 'Mensaje ' . $message->name . ' guardado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //   
    }

    public function message(string $id)
    {
        
        $message = Message::find($id);
        dd($message);
            return view('emails.reminder', ['message' => $message]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = Message::find($id);
            return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Message::find($id);
        $message->update($request->all());

        return redirect()->route('messages.edit', $message->id)
            ->with('info', 'Mensaje ' . $message->name . ' guardado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::find($id)->delete();
            return back()->with('info', 'Mensaje eliminado con éxito.');
    }
}
