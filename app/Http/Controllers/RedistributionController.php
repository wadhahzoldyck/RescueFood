<?php

namespace App\Http\Controllers;

use App\Models\Redistribution;
use App\Models\Beneficiaire;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedistributionController extends Controller
{
    /**
     * Display a listing of redistributions with search, sorting, and beneficiaire filtering.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'date');
        $order = $request->input('order', 'asc');
        $beneficiaires = Beneficiaire::all();

        $redistributions = Redistribution::with('beneficiaire')
            ->where('user_id', $userId)
            ->when($search, function ($query, $search) {
                $query->whereHas('beneficiaire', function ($q) use ($search) {
                    $q->where('nom', 'like', '%' . $search . '%');
                });
            })
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('redistributions.index', compact('redistributions', 'beneficiaires', 'search', 'sortBy', 'order'));
    }

    /**
     * Show the form for creating a new redistribution.
     */
    public function create()
    {
        $beneficiaires = Beneficiaire::all(); // Retrieve beneficiaires for the form
        $collections = Collection::all();
        return view('redistributions.create', compact('beneficiaires', 'collections'));    }

    /**
     * Store a newly created redistribution in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:' . implode(',', Redistribution::STATUSES),
            'beneficiaire_id' => 'required|exists:beneficiaires,id',
            'collection_id' => 'required|exists:collections,id',
        ]);
        $userId = Auth::id();
        $validated['user_id'] = $userId;

        Redistribution::create($validated);

        return redirect()->route('redistributions.index')->with('success', 'Redistribution créée avec succès.');
    }

    /**
     * Show the form for editing an existing redistribution.
     */
    public function edit(Redistribution $redistribution)
    {
        $beneficiaires = Beneficiaire::all(); // Retrieve all beneficiaires for the dropdown
        $collections = Collection::all();

        return view('redistributions.edit', compact('redistribution', 'beneficiaires','collections'));
    }

    /**
     * Update an existing redistribution.
     */
    public function update(Request $request, Redistribution $redistribution)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:' . implode(',', Redistribution::STATUSES),
            'beneficiaire_id' => 'required|exists:beneficiaires,id',
        ]);

        $redistribution->update($validated);

        return redirect()->route('redistributions.index')->with('success', 'Redistribution mise à jour avec succès.');
    }

    /**
     * Remove a redistribution from storage.
     */
    public function destroy(Redistribution $redistribution)
    {
        $redistribution->delete();

        return redirect()->route('redistributions.index')->with('success', 'Redistribution supprimée avec succès.');
    }
}
