<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class BeneficiaireController extends Controller
{
    /**
     * Display a listing of the resource with search and sorting.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get search and sort parameters from the request
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'nom'); // Default sort by 'nom'
        $order = $request->input('order', 'asc'); // Default order is ascending

        // Query with search and sort functionality
        $beneficiaires = Beneficiaire::query()
            ->when($search, function ($query, $search) {
                return $query->where('nom', 'like', '%' . $search . '%')
                             ->orWhere('contact', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $order)
            ->paginate(10); // Paginate results

        return view('beneficiaires.index', compact('beneficiaires', 'search', 'sortBy', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('beneficiaires.create'); // Adjust according to your view structure
    }

    /**
     * Store a newly created resource in storage with validation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input with custom error messages
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'contact.required' => 'Le contact est obligatoire.',
        ]);

        // Create the Beneficiaire
        Beneficiaire::create($validated);

        return redirect()->route('beneficiaires.index')->with('success', 'Bénéficiaire créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beneficiaire  $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiaire $beneficiaire)
    {
        return view('beneficiaires.show', compact('beneficiaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beneficiaire  $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiaire $beneficiaire)
    {
        return view('beneficiaires.edit', compact('beneficiaire'));
    }

    /**
     * Update the specified resource with validation.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiaire $beneficiaire)
    {
        // Validate the input with custom error messages
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'contact.required' => 'Le contact est obligatoire.',
        ]);

        // Update the Beneficiaire
        $beneficiaire->update($validated);

        return redirect()->route('beneficiaires.index')->with('success', 'Bénéficiaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiaire $beneficiaire)
    {
        $beneficiaire->delete();

        return redirect()->route('beneficiaires.index')->with('success', 'Bénéficiaire supprimé avec succès.');
    }
}
