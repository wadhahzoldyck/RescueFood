<?php

namespace App\Http\Controllers;

use App\Models\Don;
use App\Models\Nourriture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // Récupérer l'ID de l'utilisateur connecté

        // Mettre à jour en masse les dons expirés avant de les lister
        $this->updateExpiredDons();

        // Requête initiale incluant le filtre sur l'ID utilisateur
        $query = Don::where('user_id', $userId)->with('nourriture');

        // Recherche par quantité, statut, nom de nourriture ou type de nourriture
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('nourriture', function ($q) use ($request) {
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

        // Vérifier et mettre à jour le statut d'expiration pour chaque don
        foreach ($dons as $don) {
            $don->checkExpiration();
        }

        return view('dons.index', compact('dons'));
    }

    public function updateExpiredDons()
    {
        // Mettre à jour tous les dons expirés d'un coup
        Don::where('dateExpiration', '<', Carbon::now())
            ->where('status', 'disponible')
            ->update(['status' => 'fini']);
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

        $userId = Auth::id(); // Récupérer l'ID de l'utilisateur connecté

        // Créer un nouveau don
        $don = new Don();
        $don->user_id = $userId; // Affecter l'ID de l'utilisateur au don
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
        // Vérifier et mettre à jour le statut d'expiration du don
        $don->checkExpiration();

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
    // public function showDashboard()
    // {
    //     // Récupérer les statistiques des dons
    //     $donsToday = Don::whereDate('created_at', now())->count();
    //     $totalDons = Don::count();
    //     $donsLast30Days = Don::where('created_at', '>=', now()->subDays(30))->count();

    //     // Calculer le changement de pourcentage des dons par rapport aux 30 jours précédents
    //     $donsLast30DaysPrevious = Don::where('created_at', '<', now()->subDays(30))
    //                                   ->where('created_at', '>=', now()->subDays(60))->count();
    //     $donPercentageChange = $donsLast30DaysPrevious > 0
    //         ? (($donsLast30Days - $donsLast30DaysPrevious) / $donsLast30DaysPrevious) * 100
    //         : 100; // ou 0 si aucun don dans les 30 jours précédents

    //     // Statistiques des nourritures
    //     $nourrituresToday = Nourriture::whereDate('created_at', now())->count();
    //     $totalNourritures = Nourriture::count();
    //     $nourrituresLast30Days = Nourriture::where('created_at', '>=', now()->subDays(30))->count();

    //     // Calculer le changement de pourcentage des nourritures ajoutées
    //     $nourrituresLast30DaysPrevious = Nourriture::where('created_at', '<', now()->subDays(30))
    //                                                 ->where('created_at', '>=', now()->subDays(60))->count();
    //     $nourriturePercentageChange = $nourrituresLast30DaysPrevious > 0
    //         ? (($nourrituresLast30Days - $nourrituresLast30DaysPrevious) / $nourrituresLast30DaysPrevious) * 100
    //         : 100; // ou 0 si aucune nourriture ajoutée dans les 30 jours précédents

    //     // Statistiques supplémentaires
    //     $expiredDons = Don::where('dateExpiration', '<', now())->count();
    //     $availableDons = Don::where('dateExpiration', '>', now())->count();

    //     // Total des dons et quantités, en utilisant le champ 'quantité' du modèle Don
    //     $foodQuantityGiven = Don::select('nourriture_id', DB::raw('SUM(quantité) as total_quantity'))
    //                              ->groupBy('nourriture_id')
    //                              ->get();

    //     // Total de la nourriture collectée et en attente de collecte
    //     $foodCollected = Don::where('status', 'collected')->sum('quantité');
    //     $foodPendingCollection = Don::where('status', 'pending')->sum('quantité');

    //     return view('Restaurantspace.home', compact(
    //         'donsToday',
    //         'totalDons',
    //         'donsLast30Days',
    //         'donPercentageChange',
    //         'nourrituresToday',
    //         'totalNourritures',
    //         'nourrituresLast30Days',
    //         'nourriturePercentageChange',
    //         'expiredDons',
    //         'availableDons',
    //         'foodQuantityGiven',
    //         'foodCollected',
    //         'foodPendingCollection'
    //     ));
    // }



    public function showDashboard()
    {
        // Récupérer les statistiques des dons
        $donsToday = Don::whereDate('created_at', now())->count();
        $totalDons = Don::count();
        $donsLast30Days = Don::where('created_at', '>=', now()->subDays(30))->count();

        // Calculer le changement de pourcentage des dons par rapport aux 30 jours précédents
        $donsLast30DaysPrevious = Don::where('created_at', '<', now()->subDays(30))
                                      ->where('created_at', '>=', now()->subDays(60))->count();
        $donPercentageChange = $donsLast30DaysPrevious > 0
            ? (($donsLast30Days - $donsLast30DaysPrevious) / $donsLast30DaysPrevious) * 100
            : 100; // ou 0 si aucun don dans les 30 jours précédents

        // Statistiques des nourritures
        $nourrituresToday = Nourriture::whereDate('created_at', now())->count();
        $totalNourritures = Nourriture::count();
        $nourrituresLast30Days = Nourriture::where('created_at', '>=', now()->subDays(30))->count();

        // Calculer le changement de pourcentage des nourritures ajoutées
        $nourrituresLast30DaysPrevious = Nourriture::where('created_at', '<', now()->subDays(30))
                                                    ->where('created_at', '>=', now()->subDays(60))->count();
        $nourriturePercentageChange = $nourrituresLast30DaysPrevious > 0
            ? (($nourrituresLast30Days - $nourrituresLast30DaysPrevious) / $nourrituresLast30DaysPrevious) * 100
            : 100; // ou 0 si aucune nourriture ajoutée dans les 30 jours précédents

        // Statistiques supplémentaires
        $expiredDons = Don::where('dateExpiration', '<', now())->count();
        $availableDons = Don::where('dateExpiration', '>', now())->count();

        // Total des dons et quantités par type de nourriture
        $foodQuantityGiven = Don::select('nourriture_id', DB::raw('SUM(quantité) as total_quantity'))
                                 ->groupBy('nourriture_id')
                                 ->with('nourriture') // Assurez-vous que le modèle a la relation
                                 ->get();

        // Récupérer les détails des dons par type de nourriture
        $donsDetailsByNourriture = Don::with('nourriture')
                                      ->select('nourriture_id', DB::raw('SUM(quantité) as total_quantity'))
                                      ->groupBy('nourriture_id')
                                      ->get()
                                      ->map(function ($don) {
                                          return [
                                              'nourriture' => $don->nourriture->nom, // Récupérer le nom de la nourriture
                                              'total_quantity' => $don->total_quantity,
                                          ];
                                      });

        // Total de la nourriture collectée et en attente de collecte
        $foodCollected = Don::where('status', 'collected')->sum('quantité');
        $foodPendingCollection = Don::where('status', 'pending')->sum('quantité');

        return view('Restaurantspace.home', compact(
            'donsToday',
            'totalDons',
            'donsLast30Days',
            'donPercentageChange',
            'nourrituresToday',
            'totalNourritures',
            'nourrituresLast30Days',
            'nourriturePercentageChange',
            'expiredDons',
            'availableDons',
            'foodQuantityGiven',
            'foodCollected',
            'foodPendingCollection',
            'donsDetailsByNourriture' // Ajouter les détails des dons par nourriture
        ));
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
