<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collecte;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Log;

class FacebookController extends Controller
{
    public function postToFacebook($id)
    {
        // Trouver la collecte par ID
        $collecte = Collecte::findOrFail($id);

        // Initialiser le SDK Facebook
        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v12.0',
        ]);

        // Définir le jeton d'accès de la page
        $pageAccessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');
        $baseUrl = env('APP_URL');
        // Préparer les données à publier
         $linkData = [
            'message' => 'Découvrez notre collecte : ' . $collecte->nom . ', Type de déchet: ' . $collecte->type_dechet,
        ];
        try {
            $response = $fb->post('/121706011035540/feed', $linkData, $pageAccessToken);
            $graphNode = $response->getGraphNode();

            // Log the response for debugging
            Log::info('Facebook Response:', ['response' => $graphNode]);

            if (isset($graphNode['id'])) {
                return redirect()->back()->with('success', 'Publié avec succès avec l\'ID : ' . $graphNode['id']);
            } else {
                return redirect()->back()->with('error', 'Publication échouée : ID non trouvé dans la réponse.');
            }
        } catch (FacebookSDKException $e) {
            Log::error('Facebook SDK error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la publication : ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur inattendue : ' . $e->getMessage());
        }

    }
}
