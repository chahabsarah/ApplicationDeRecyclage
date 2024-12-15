<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::with('claims')->get();

        return view('categories.index', ["categories" =>  $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate the category name
        ]);

        Categories::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully'); // Redirect back with success message
    }

    public function destroy($id)
    {
        $claim = Categories::findOrFail($id);
        $claim->delete();
        return redirect('/categories')->with('success', 'Categorie deleted successfully!');
    }

}
