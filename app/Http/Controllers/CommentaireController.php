<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\BonnePratique;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'nom' => 'required|string|min:3|max:10|', // Validation for nom
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Ensure the photo is optional
            'description' => 'required|string|min:3|max:500', // Added max length for description
        ]);

        $commentaire = new Commentaire($request->only(['nom', 'description'])); // Only get required fields
        $commentaire->bonne_pratique_id = $id;

        // Handle the uploaded image
        if ($request->hasFile('photo')) {
            $commentaire->photo = $request->file('photo')->store('commentaires', 'public');
        }

        $commentaire->save();

        // Redirect to the bonne pratique page with success message
        return redirect()->route('bonne_pratiques.show', $id)->with('success', 'Commentaire ajouté avec succès.');
    }

    public function edit($id)
{
    $commentaire = Commentaire::findOrFail($id);
    return view('commentaires.edit', compact('commentaire'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|min:3max:255',
        'description' => 'required|min:3|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $commentaire = Commentaire::findOrFail($id);
    $commentaire->nom = $request->nom;
    $commentaire->description = $request->description;

    // Handle the photo upload
    if ($request->hasFile('photo')) {
        $commentaire->photo = $request->file('photo')->store('commentaires', 'public');
    }

    $commentaire->save();

    return redirect()->route('bonne_pratiques.show', $commentaire->bonne_pratique_id)
                     ->with('success', 'Commentaire mis à jour avec succès.');
}

public function destroy($id)
{
    // Find the comment by its ID
    $commentaire = Commentaire::find($id);

    // Check if the comment exists
    if (!$commentaire) {
        return redirect()->back()->with('error', 'Commentaire non trouvé.');
    }

    // Delete the comment
    $commentaire->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Commentaire supprimé avec succès.');
}

}
