<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class AdminLivreurController extends Controller
{
    /**
     * Display a listing of all livreurs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all livreurs without filtering by user_id
        $livreurs = Livreur::all();
        return view('Adminspace.livreur.index', compact('livreurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Adminspace.livreur.create');
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
            'nom' => 'required|string|min:3|max:255',
            'telephone' => 'required|numeric',
            'vehicule' => 'required|string|min:3|max:255',
            'zone_couverture' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:livreurs,email',
        ]);

        Livreur::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'vehicule' => $request->vehicule,
            'disponibilite' => $request->disponibilite,
            'zone_couverture' => $request->zone_couverture,
            'email' => $request->email,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('livreursadmin.index')->with('success', 'Livreur ajouté avec succès!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livreur = Livreur::findOrFail($id);
        return view('Adminspace.livreur.edit', compact('livreur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|min:3',
            'telephone' => 'required|numeric',
            'vehicule' => 'required',
            'disponibilite' => 'required|boolean',
            'zone_couverture' => 'required',
        ]);

        $livreur = Livreur::findOrFail($id);
        $livreur->update($request->all());

        return redirect()->route('livreursadmin.index')->with('success', 'Livreur modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();
        return redirect()->route('Adminspace.livreurs.index')->with('success', 'Livreur supprimé avec succès!');
    }
}
