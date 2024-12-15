<?php

namespace App\Http\Controllers;

use App\Models\CentreDeRecyclage;
use Illuminate\Http\Request;

class CentreDeRecyclageController extends Controller
{
    public function index()
    {
        $centres = CentreDeRecyclage::all();
        return view('centres.index', compact('centres'));
    }
    public function indexFrontOffice()
    {
        $centres = CentreDeRecyclage::all();
        return view('centres.indexFrontOffice', compact('centres'));
    }

    public function create()
    {
        return view('centres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3|max:10',
            'localisation' => 'required',
            'numero_telephone' => 'nullable|min:8|max:8',
            'email' => 'nullable|email',
            'description' => 'required|max:100',
            'site_web' => 'nullable|url',
            'type_dechet' => 'required|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nom.required' => 'Le nom est requis.',
            'nom.min' => 'Le nom doit avoir au moins 3 caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 10 caractères.',
            'localisation.required' => 'L\'adresse est requise.',
            'numero_telephone.min' => 'Le numéro de téléphone doit contenir 8 chiffres.',
            'numero_telephone.max' => 'Le numéro de téléphone doit contenir 8 chiffres.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'description.required' => 'La description est requise.',
            'description.max' => 'La description ne peut pas dépasser 100 caractères.',
            'site_web.url' => 'Veuillez entrer une URL valide.',
            'type_dechet.required' => 'Veuillez sélectionner au moins un type de déchet.',
            'logo.image' => 'Le fichier doit être une image.',
            'logo.mimes' => 'L\'image doit être au format jpeg, png, jpg, ou gif.',
            'logo.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        ]);

        $data = $request->except('logo');
        $data['type_dechet'] = json_encode($request->input('type_dechet'));

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        CentreDeRecyclage::create($data);

        return redirect()->route('centres.index')->with('success', 'Centre ajouté avec succès.');
    }

    public function edit($id)
    {
        $centre = CentreDeRecyclage::find($id);
        if (!$centre) {
            return redirect()->route('centres.index')->with('error', 'Centre non trouvé.');
        }
        return view('centres.edit', compact('centre'));
    }

    public function update(Request $request, $id)
    {
        $centre = CentreDeRecyclage::find($id);
        if (!$centre) {
            return redirect()->route('centres.index')->with('error', 'Centre non trouvé.');
        }

        $request->validate([
            'nom' => 'required',
            'localisation' => 'required',
            'numero_telephone' => 'nullable',
            'email' => 'nullable|email',
            'description' => 'required',
            'site_web' => 'nullable|url',
            'type_dechet' => 'required|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('logo');
        $data['type_dechet'] = json_encode($request->input('type_dechet'));

        if ($request->hasFile('logo')) {
            if ($centre->logo) {
                \Storage::disk('public')->delete($centre->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $centre->update($data);

        return redirect()->route('centres.index')->with('success', 'Centre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $centre = CentreDeRecyclage::find($id);
        if (!$centre) {
            return redirect()->route('centres.index')->with('error', 'Centre non trouvé.');
        }

        if ($centre->logo) {
            \Storage::disk('public')->delete($centre->logo);
        }

        $centre->delete();

        return redirect()->route('centres.index')->with('success', 'Centre supprimé avec succès.');
    }
    public function show($id)
    {
        $centre = CentreDeRecyclage::findOrFail($id);

        return view('centres.show', compact('centre'));
    }
    public function showFrontOffice($id)
    {
        $centre = CentreDeRecyclage::findOrFail($id);

        return view('centres.showFrontOffice', compact('centre'));
    }
}
