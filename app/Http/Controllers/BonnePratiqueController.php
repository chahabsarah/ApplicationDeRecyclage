<?php

namespace App\Http\Controllers;

use App\Models\BonnePratique;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BonnePratiqueController extends Controller
{
    public function index(Request $request)
    {
        $query = BonnePratique::query();

        // If a search term is provided, filter the results
        if ($request->has('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('category', 'LIKE', '%' . $request->search . '%');
        }

        // Paginate the results (10 per page, adjust as needed)
        $bonne_pratiques = $query->paginate(6);

        return view('bonne_pratiques.index', compact('bonne_pratiques'));
    }


    public function create()
    {
        return view('bonne_pratiques.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:10|min:3',
            'description' => 'required|string|max :10',
            'category' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the picture and create the BonnePratique
        $path = $request->file('picture') ? $request->file('picture')->store('images', 'public') : null;

        BonnePratique::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'picture' => $path,
        ]);

        return redirect()->route('bonne_pratiques.index')->with('success', 'Bonne pratique créée avec succès.');
    }

    public function show($id)
    {
        // Récupérer la bonne pratique par ID
        $bonnePratique = BonnePratique::with('commentaires')->findOrFail($id);

        // Utiliser la relation pour récupérer les commentaires
        $comments = $bonnePratique->commentaires; // Utilise la relation définie

        return view('bonne_pratiques.show', compact('bonnePratique', 'comments'));
    }



    public function edit(BonnePratique $bonnePratique)
    {
        return view('bonne_pratiques.edit', compact('bonnePratique'));
    }

    public function update(Request $request, BonnePratique $bonnePratique)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the picture and update the BonnePratique
        $path = $request->file('picture') ? $request->file('picture')->store('images') : $bonnePratique->picture;

        $bonnePratique->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'picture' => $path,
        ]);

        return redirect()->route('bonne_pratiques.index')->with('success', 'Bonne pratique mise à jour avec succès.');
    }

    public function destroy(BonnePratique $bonnePratique)
    {
        $bonnePratique->delete();
        return redirect()->route('bonne_pratiques.index')->with('success', 'Bonne pratique supprimée avec succès.');
    }

    public function indexFrontOffice(Request $request)
    {
        $query = BonnePratique::query();

        // If a search term is provided, filter the results
        if ($request->has('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('category', 'LIKE', '%' . $request->search . '%');
        }

        $bonne_pratiques = $query->paginate(6); // Adjust pagination as needed
        return view('bonne_pratiques.indexfrontoffice', compact('bonne_pratiques'));
    }




public function exportPDF()
{
    $bonne_pratiques = BonnePratique::all();

    // Générer le contenu HTML
    $html = $this->generatePDFContent($bonne_pratiques);

    // Charger le contenu HTML dans Dompdf
    $pdf = Pdf::loadHTML($html);

    // Télécharger le fichier PDF
    return $pdf->download('bonnes_pratiques.pdf');
}

private function generatePDFContent($bonne_pratiques)
{
    $content = '<h1>Bonnes Pratiques</h1>';
    foreach ($bonne_pratiques as $pratique) {
        $content .= '<div style="margin-bottom: 20px;">';
        $content .= '<h2>' . $pratique->title . '</h2>';
        $content .= '<p>' . $pratique->description . '</p>';
        $content .= '<p>Catégorie: ' . $pratique->category . '</p>';

        // Vérifiez si une image est disponible pour l'élément
        if ($pratique->picture) {
            $imagePath = asset('images/' . $pratique->picture);
            $content .= '<img src="' . $imagePath . '" alt="Image" style="width:100px; height:auto;">';
        }
        $content .= '</div>';
    }
    return $content;
}



public function exportExcel()
{
    $bonnePratiques = BonnePratique::all(); // Fetch all records

    // Create a temporary array to hold the data
    $dataArray = [];
    foreach ($bonnePratiques as $pratique) {
        $dataArray[] = [
            'ID' => $pratique->id,
            'Title' => $pratique->title,
            'Description' => $pratique->description,
            'Category' => $pratique->category,
            'Picture' => $pratique->picture ? asset('images/' . $pratique->picture) : null,
        ];
    }

    // Create an Excel file
    return Excel::download(new class($dataArray) implements FromCollection, WithHeadings {
        protected $dataArray;

        public function __construct(array $dataArray)
        {
            $this->dataArray = $dataArray;
        }

        public function collection()
        {
            return collect($this->dataArray);
        }

        public function headings(): array
        {
            return [
                'ID',
                'Title',
                'Description',
                'Category',
                'Picture',
            ];
        }
    }, 'bonnes_pratiques.xlsx');
}

}
