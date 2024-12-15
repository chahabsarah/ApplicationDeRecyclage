<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentreDeRecyclage;
use PDF;
use Dompdf\Dompdf;


class PDFController extends Controller
{
    /**
     * Génère un PDF des centres de recyclage en orientation paysage.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        // Récupère les centres de recyclage
        $centers = CentreDeRecyclage::get();

        // Passe les données à la vue
        $data = [
            'centres' => $centers
        ];

        // Charge la vue et configure le PDF en mode paysage (landscape)
        $pdf = PDF::loadView('myPDF', $data)->setPaper('a4', 'landscape');

        // Télécharge le fichier PDF généré
        return $pdf->download('centres_list.pdf');
    }
}
