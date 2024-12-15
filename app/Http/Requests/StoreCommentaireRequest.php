<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentaireRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser tous les utilisateurs à faire cette requête
    }

    public function rules()
    {
        return [
            'content' => 'required|string|min:3|max:500', // Ajustez la longueur max si nécessaire
            'nom' => 'required|string|min:3|max:10|', // Validation pour le nom

        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Le contenu est obligatoire.',
            'nom.required' => 'Le nom est obligatoire.',
            'content.min' => 'Le commentaire doit contenir au moins 3 caractères.',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 10 caractères.',
        ];
    }
}
