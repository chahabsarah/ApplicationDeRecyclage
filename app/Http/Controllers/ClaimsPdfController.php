<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claims;
use PDF;
use Dompdf\Dompdf;


class ClaimsPdfController extends Controller
{
    /**
     * Génère un PDF des claims en orientation paysage.
     *
     * @return \Illuminate\Http\Response
     */
    public function ClaimsPDF()
    {
        $claims = claims::get();

        // Passe les données à la vue
        $data = [
            'claims' => $claims
        ];

        // Charge la vue et configure le PDF en mode paysage (landscape)
        $pdf = PDF::loadView('claimsPdf', $data)->setPaper('a4', 'landscape');

        // Télécharge le fichier PDF généré
        return $pdf->download('claims_list.pdf');
    }
}
