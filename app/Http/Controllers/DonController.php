<?php

namespace App\Http\Controllers;

use App\Models\Don;
use App\Models\Nourriture;
use Illuminate\Http\Request;

class DonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Don::with('nourriture');

        // Recherche par quantité, statut, nom de nourriture ou type de nourriture
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('nourriture', function($q) use ($request) {
                $q->where('nom', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('type', 'LIKE', '%' . $request->search . '%'); // Recherche par type de nourriture
            })
            ->orWhere('quantité', 'LIKE', '%' . $request->search . '%')
            ->orWhere('status', 'LIKE', '%' . $request->search . '%')
            ->orWhere('dateExpiration', 'LIKE', '%' . $request->search . '%');
        }

        // Tri par un champ spécifié
        if ($request->has('sort')) {
            $order = $request->order === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort, $order);
        }

        // Récupérer les dons avec pagination
        $dons = $query->paginate(10); // Changez 10 en le nombre de résultats par page que vous souhaitez

        return view('dons.index', compact('dons'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 // Récupérer toutes les nourritures
 $nourritures = Nourriture::all();
 return view('dons.create', compact('nourritures')); // Passer $nourritures dans la vue create

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validation des données
    $request->validate([
        'nourriture_id' => 'required|exists:nourritures,id',
        'quantité' => 'required|integer|min:1',
        'dateExpiration' => 'required|date',
        'status' => 'required|string',
        'dateCollectePrevue' => 'required|date',
    ]);

    // Créer un nouveau don
    $don = new Don();
    $don->nourriture_id = $request->nourriture_id; // Affecter l'ID de la nourriture au don
    $don->quantité = $request->quantité;
    $don->dateExpiration = $request->dateExpiration;
    $don->status = $request->status;
    $don->dateCollectePrevue = $request->dateCollectePrevue;
    $don->save();

    return redirect()->route('dons.index')->with('success', 'Don créé avec succès.');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Don $don)
    {
        return view('dons.show', compact('don'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Don $don)
    {
        $nourritures = Nourriture::all();
        return view('dons.edite', compact('don', 'nourritures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Don $don)
    {
        $request->validate([
            'nourriture_id' => 'required|exists:nourritures,id',
            'quantité' => 'required|integer|min:1',
            'dateExpiration' => 'required|date',
            'status' => 'required|in:' . implode(',', Don::STATUSES),
            'dateCollectePrevue' => 'nullable|date',
        ]);

        $don->update($request->all());

        return redirect()->route('dons.index')->with('success', 'Don updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Don $don)
    {
        $don->delete();

        return redirect()->route('dons.index')->with('success', 'Don deleted successfully.');
    }
}
