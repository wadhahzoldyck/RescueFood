<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Don;


class CollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return view('Associationspace.collection.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dons = Don::whereDoesntHave('collection')->get();
        return view('Associationspace.collection.create',compact('dons'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$request->validate([
       
        'etat' => 'required|string',
        'dateCollecte' => 'required|date',
    ]);
    $collection = Collection::create($request->only('dateCollecte', 'etat'));

    
    Don::whereIn('id', $request->dons)->update(['collection_id' => $collection->id]);

    return redirect()->route('collect.index')->with('success', 'Collection created successfully.');    
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
        $collection = Collection::findOrFail($id);
        return view('Associationspace.collection.edit', compact('collection'));    }

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
       
            'etat' => 'required|string',
            'dateCollecte' => 'required|date',
        ]);

        $collect = Collection::findOrFail($id);
        $collect->update($request->all());

        return redirect()->route('collect.index')->with('success', 'collection modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        
        $collection = Collection::findOrFail($id);
        $collection->delete();
        return redirect()->route('collect.index')->with('success', 'collection supprimé avec succès!');
    
    }
}
