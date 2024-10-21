<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommandation;
use App\Models\Nourriture;

class RecommandationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommandations = Recommandation::with('nourriture')->get(); 
        return view('Associationspace.Recommandation.listRecommandation', compact('recommandations'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $nourritures = Nourriture::all();
        return view('Associationspace.Recommandation.addRecommandation', compact('nourritures'));
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
            'nourriture_id' => 'required|exists:nourritures,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string',
            'priorite' => 'required|integer|min:1|max:3',
        ]);
    
        $recommandation = new Recommandation;
        $recommandation->titre = $request->titre;
        $recommandation->nourriture_id=$request->nourriture_id; 

        $recommandation->description = $request->description;
        $recommandation->categorie = $request->categorie;
        $recommandation->priorite = $request->priorite;
    
        
        $recommandation->save();
    
        
        return redirect()->route('recommandations.index')->with('success', 'Recommandation enregistrée avec succès!');
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
        $nourritures = Nourriture::all();
        $recommandation = Recommandation::findOrFail($id);
    
        
        return view('Associationspace.Recommandation.editRecommandation', compact('recommandation','nourritures'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, Recommandation $recommandation)
{
    
    $request->validate([
        'nourriture_id' => 'required|exists:nourritures,id',
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'categorie' => 'required|string',
        'priorite' => 'required|integer|min:1|max:3',
    ]);
    $recommandation->nourriture_id=$request->nourriture_id; 
    $recommandation->titre = $request->titre;
    $recommandation->description = $request->description;
    $recommandation->categorie = $request->categorie;
    $recommandation->priorite = $request->priorite;

    $recommandation->save();

    return redirect()->route('recommandations.index')->with('success', 'Recommandation mise à jour avec succès!');
}

 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */public function destroy($id)
{
    $recommandation = Recommandation::findOrFail($id);
    $recommandation->delete(); 

    
    return redirect()->route('recommandations.index')->with('success', 'Recommandation supprimée avec succès!');
}
}
