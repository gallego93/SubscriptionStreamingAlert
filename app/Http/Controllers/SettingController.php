<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('settings.edit', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'category' => 'required|string',
            'keys'     => 'required|array',
            'values'   => 'required|array',
        ]);

        foreach ($data['keys'] as $index => $key) {
            $value = $data['values'][$index];

            Setting::updateOrCreate(
                ['category' => $data['category'], 'key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Configuraciones guardadas correctamente.');
    }
}
