<?php

namespace App\Http\Controllers;

use App\Models\Nourriture;
use Illuminate\Http\Request;

class NourritureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Nourriture::query();

        // Recherche par nom ou type
        if ($request->has('search') && $request->search != '') {
            $query->where('nom', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('type', 'LIKE', '%' . $request->search . '%');
        }

        // Tri par un champ spécifié
        if ($request->has('sort')) {
            $order = $request->order === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort, $order);
        }

        // Récupérer les nourritures avec pagination
        $nourritures = $query->paginate(10); // Changez 10 en le nombre de résultats par page que vous souhaitez

        return view('nourritures.index', compact('nourritures'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nourritures.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', Nourriture::TYPES_NOURRITURE),
        ]);

        Nourriture::create($request->all());

        return redirect()->route('nourritures.index')->with('success', 'Nourriture created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nourriture $nourriture)
    {
        return view('nourritures.show', compact('nourriture'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nourriture $nourriture)
    {
        return view('nourritures.edit', compact('nourriture'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nourriture $nourriture)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'sometimes|required|in:' . implode(',', Nourriture::TYPES_NOURRITURE),
        ]);

        $nourriture->update($request->all());

        return redirect()->route('nourritures.index')->with('success', 'nourritures updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nourriture $nourriture)
    {
        $nourriture->delete();

        return redirect()->route('nourritures.index')->with('success', 'Beneficiaire deleted successfully.');

    }
}
