<?php

namespace App\Http\Controllers;

use App\Models\Claims;
use App\Models\Categories;
use Illuminate\Http\Request;


class ClaimsController extends Controller
{
    public function index()
    {

        return view('claims.index', ["claims" =>  Claims::with('categories')->get(), 'categories' => Categories::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
        ]);

        $claims = new Claims;
        $claims->username = $request->first_name . ' ' . $request->last_name;
        $claims->description = $request->description;
        $claims->categories_id = $request->categories_id;
        $claims->save();

        return redirect('/claims');
    }

    public function view()
    {
        return view('claims.displayclaims', ["claims" => Claims::all(), 'categories' => Categories::all()]);
    }



    public function update(Request $request, $id)
    {
        $claim = Claims::findOrFail($id);
        $claim->username = $request->username; // Update fields accordingly
        $claim->description = $request->description;

        $claim->save();

        return redirect('/claims')->with('success', 'Claim updated successfully!');
    }

    public function destroy($id)
    {
        $claim = Claims::findOrFail($id);
        $claim->delete();
        return redirect('/claims')->with('success', 'Claim deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('s');

        $claims = Claims::where('username', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('categories')
            ->get();

        return view('claims.index', ["claims" =>  $claims, 'categories' => Categories::all()]);
    }
}
