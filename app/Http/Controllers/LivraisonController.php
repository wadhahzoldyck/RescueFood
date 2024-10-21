<?php

namespace App\Http\Controllers;

use App\Mail\LivraisonAffectee;
use App\Models\Livraison;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livraisons = Livraison::with('livreur')->get();
        return view('Associationspace.Livraison.index', compact('livraisons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $livreurs = Livreur::all();
        $etats = [
            'Ariana',
            'Béja',
            'Ben Arous',
            'Bizerte',
            'Gabès',
            'Gafsa',
            'Jendouba',
            'Kairouan',
            'Kasserine',
            'Kébili',
            'Le Kef',
            'Mahdia',
            'La Manouba',
            'Médenine',
            'Monastir',
            'Nabeul',
            'Sfax',
            'Sidi Bouzid',
            'Siliana',
            'Sousse',
            'Tataouine',
            'Tozeur',
            'Tunis',
            'Zaghouan'
        ];

        $distributions = [
            ['id' => 1, 'nom' => 'Distribution Temporaire 1'],
            ['id' => 2, 'nom' => 'Distribution Temporaire 2'],
        ];

        return view('Associationspace.Livraison.create', compact('livreurs', 'etats', 'distributions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'adresse' => 'required|string|max:255',
            'etat' => 'required|string',
            'date_livraison' => 'required|date',
            'livreur_id' => 'required|exists:livreurs,id',
            'distribution_id' => 'nullable|exists:distributions,id',
        ]);

        $livraison = Livraison::create([
            'adresse' => $request->adresse,
            'etat' => $request->etat,
            'date_livraison' => $request->date_livraison,
            'livreur_id' => $request->livreur_id,
            // 'distribution_id' => $request->distribution_id,
        ]);
        $livreur = $livraison->livreur;

        if ($livreur && $livreur->email) {
            Mail::to($livreur->email)->send(new LivraisonAffectee($livraison));
        } else {
            return redirect()->route('livraison.index')->with('error', 'Erreur: l\'email du livreur n\'est pas défini.');
        }

        return redirect()->route('livraison.index')->with('success', 'Livraison ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $livraison = Livraison::findOrFail($id);
        $livreurs = Livreur::all();
        $distributions = [
            ['id' => 1, 'nom' => 'Distribution Temporaire 1'],
            ['id' => 2, 'nom' => 'Distribution Temporaire 2'],
        ];

        return view('Associationspace.Livraison.edit', compact('livraison', 'livreurs', 'distributions'));
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
        //
        $request->validate([
            'adresse' => 'required|string|max:255',
            'date_livraison' => 'required|date',
            'livreur_id' => 'nullable|exists:livreurs,id',
            // 'distribution_id' => 'nullable|exists:distributions,id',
            'etat' => 'required|string',
        ]);

        $livraison = Livraison::findOrFail($id);
        $livraison->update([
            'adresse' => $request->adresse,
            'date_livraison' => $request->date_livraison,
            'livreur_id' => $request->livreur_id,
            'etat' => $request->etat,
        ]);

        return redirect()->route('livraison.index')->with('success', 'Livraison mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $livraison = Livraison::findOrFail($id);
        $livraison->delete();
        return redirect()->route('livraison.index')->with('success', 'Livraison supprimée avec succès !');
    }
}
