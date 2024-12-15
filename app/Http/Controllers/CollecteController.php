<?php

namespace App\Http\Controllers;

use App\Models\Collecte;
use App\Models\Phase;
use App\Models\FluxDeDonnees;
use App\Models\CentreDeRecyclage;

use Illuminate\Http\Request;

class CollecteController extends Controller
{
    // Afficher la liste des collectes
    public function index()
    {
        $collectes = Collecte::with('centreDeRecyclage')->get();
         return view('collectes.index', compact('collectes'));

    }
    public function indexFrontOffice()
    {
        $collectes = Collecte::with('centreDeRecyclage')->get();
         return view('collectes.indexFrontOffice', compact('collectes'));

    }

    // Afficher le formulaire de création de collecte
    public function create()
    {
        $centres = CentreDeRecyclage::all();
        return view('collectes.create', compact('centres'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:10|min:3',
            'etat' => 'required|string|max:30',
            'type_dechet' => 'required|string|max:255',
            'output' => 'nullable|array',
            'output.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|image|max:2048',
            'poids_contenu' => 'required|numeric|between:100,10000',
            'output_description' => 'nullable|string',
            'centre_de_recyclage_id' => 'required|exists:centres_de_recyclage,id',
        ], [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 10 caractères.',
            'nom.min' => 'Le nom doit comporter au moins 3 caractères.',
            'etat.required' => 'Le champ état est obligatoire.',
            'etat.max' => 'L\'état ne doit pas dépasser 30 caractères.',
            'type_dechet.required' => 'Le champ type de déchet est obligatoire.',
            'output.*.image' => 'Chaque fichier doit être une image.',
            'output.*.mimes' => 'Les images doivent être au format jpeg, png, jpg, gif ou svg.',
            'image.required' => 'Une image est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'poids_contenu.required' => 'Le champ poids contenu est obligatoire.',
            'poids_contenu.numeric' => 'Le poids contenu doit être un nombre.',
            'poids_contenu.between' => 'Le poids contenu doit être entre 100kg et 10000kg.',
            'centre_de_recyclage_id.required' => 'Le centre de recyclage est obligatoire.',
            'centre_de_recyclage_id.exists' => 'Le centre de recyclage sélectionné est invalide.',
        ]);

        $outputImages = [];
        if ($request->hasFile('output')) {
            foreach ($request->file('output') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/output_images', $name);
                $outputImages[] = $name;
            }
        }

        $collecte = new Collecte($validatedData);
        $collecte->output = $outputImages;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('collecte_images', 'public');
            $collecte->image = $imagePath;
        }

        $collecte->centre_de_recyclage_id = $request->centre_de_recyclage_id;

        $collecte->save();

        return redirect()->route('collectes.index')->with('success', 'Collecte créée avec succès');
    }


    // Afficher une collecte spécifique
    public function show($id)
    {
        $collecte = Collecte::findOrFail($id);
        return view('collectes.show', compact('collecte'));
    }
    public function showFrontOffice($id)
    {
        $collecte = Collecte::findOrFail($id);
        return view('collectes.showFrontOffice', compact('collecte'));
    }
    // Afficher le formulaire d'édition d'une collecte

    public function edit($id)
{
    $collecte = Collecte::findOrFail($id);
    $centres = CentreDeRecyclage::all();
    return view('collectes.edit', compact('collecte', 'centres'));
}


// Mettre à jour une collecte existante
public function update(Request $request, $id)
{
    $collecte = Collecte::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:10|min:3',
        'etat' => 'required|string',
        'type_dechet' => 'required|string',
        'output' => 'required|array',
        'output.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'poids_contenu' => 'nullable|numeric',
        'output_description' => 'required|string|min:7|max:30',
        'centre_de_recyclage_id' => 'required|exists:centres_de_recyclage,id', // Foreign key validation
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $collecte->image = $path;
    }

    $outputImages = [];
    if ($request->hasFile('output')) {
        foreach ($request->file('output') as $file) {
            $name = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/output_images', $name);
            $outputImages[] = $name;
        }
    }

    // Save the new state of the collecte
    $collecte->nom = $request->nom;
    $collecte->etat = $request->etat; // New state
    $collecte->type_dechet = $request->type_dechet;
    $collecte->poids_contenu = $request->poids_contenu;
    $collecte->output_description = $request->output_description;
    $collecte->centre_de_recyclage_id = $request->centre_de_recyclage_id;
    $collecte->output = $outputImages;

    $collecte->save();

    // Now, let's add a new phase in the related flux_de_donnees
    $fluxDeDonnees = $collecte->fluxDeDonnees; // Assuming you have a relation defined in Collecte
    if (!$fluxDeDonnees) {
        // Create a new fluxDeDonnees for this collecte
        $fluxDeDonnees = new FluxDeDonnees();
        $fluxDeDonnees->collecte_id = $collecte->id;
        $fluxDeDonnees->save();

        // Associate the fluxDeDonnees with the collecte
        $collecte->fluxDeDonnees()->save($fluxDeDonnees);
    }
    $this->addPhase($fluxDeDonnees->id, $collecte->etat, $outputImages, $request->output_description);

    return redirect()->route('collectes.index')->with('success', 'Collecte mise à jour avec succès.');
}

    // Supprimer une collecte
    public function destroy($id)
    {
        $collecte = Collecte::findOrFail($id);
        $collecte->delete();

        return redirect()->route('collectes.index')->with('success', 'Collecte supprimée avec succès');
    }
    protected function addPhase($fluxDeDonneesId, $etat, $outputImages, $outputDescription)
    {
        $phase = new Phase();
        $phase->flux_de_donnees_id = $fluxDeDonneesId;
        $phase->etat = $etat;
        $phase->output_images =$outputImages; // Convert the array of images to JSON
        $phase->output_description = $outputDescription;
        $phase->save();
    }
    public function showFluxDeDonnees($id)
    {
        $collecte = Collecte::with(['centreDeRecyclage', 'fluxDeDonnees.phases'])->findOrFail($id);

        return view('collectes.show_flux_de_donnees', compact('collecte'));
    }
    public function showFluxDeDonneesFrontOffice($id)
    {
        $collecte = Collecte::with(['centreDeRecyclage', 'fluxDeDonnees.phases'])->findOrFail($id);

        return view('collectes.showFluxDeDonneesFrontOffice', compact('collecte'));
    }

}
