<?php

namespace App\Http\Controllers;
use App\Models\Efemeride;

use Illuminate\Http\Request;

class EfemerideController extends Controller
{

    public function panel()
    {
        return view('efemerides.panel');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $efemerides = Efemeride::orderBy('date', 'desc')->get();
        return view('efemerides.index', compact('efemerides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('efemerides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|string', // cambiamos de 'date' a 'string' porque escribes dd/mm/yyyy
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',            
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        //Convertir de dd/mm/yyyy a yyyy-mm-dd antes de guardar
        $dateParts = explode('/', $request->date);
        if (count($dateParts) === 3) {
            $formattedDate = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}";
        } else {
            $formattedDate = $request->date;
        }

        //Crear la efeméride con la fecha formateada
        Efemeride::create([
            'date' => $formattedDate,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('efemerides.index')
                        ->with('success', 'Efeméride creada exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $efemeride = Efemeride::findOrFail($id);

        return view('efemerides.show', compact('efemeride'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $efemeride = Efemeride::findOrFail($id);
        return view('efemerides.edit', compact('efemeride'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required|string', // cambia de 'date' a 'string'
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        $efemeride = Efemeride::findOrFail($id);

        // Convertir de dd/mm/yyyy a yyyy-mm-dd
        $dateParts = explode('/', $request->date);
        if (count($dateParts) === 3) {
            $formattedDate = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}";
        } else {
            $formattedDate = $request->date; // fallback por si ya está en formato correcto
        }

        // Actualizar los datos
        $efemeride->update([
            'date' => $formattedDate,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('efemerides.index')
                        ->with('success', 'Efeméride actualizada exitosamente.');
    }

    public function indexPublic()
    {
        $efemerides = Efemeride::select('id', 'title', 'date')
            ->orderByRaw('MONTH(date) DESC')
            ->orderByRaw('DAY(date) DESC')
            ->get();

        if ($efemerides->isEmpty()) {
            return view('efemerides.public_index', [
                'efemerides' => collect(),
            ]);
        }

        $today = now();

        $activeIndex = $efemerides->search(function ($efemeride) use ($today) {
            return \Carbon\Carbon::parse($efemeride->date)
                ->setYear($today->year)
                ->gte($today);
        });

        if ($activeIndex === false) {
            $activeIndex = 0;
        }

        $ordered = $efemerides->slice($activeIndex)
            ->merge($efemerides->slice(0, $activeIndex))
            ->values();

        return view('efemerides.public_index', [
            'efemerides' => $ordered
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $efemeride = Efemeride::findOrFail($id);
        $efemeride->delete();

        return redirect()->route('efemerides.index')
                         ->with('success', 'Efeméride eliminada correctamente.');
    }
}
