<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBonnePratiqueRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:150',
            'description' => 'required|string',
            'category' => 'required|in:Recycling,Composting,Waste Reduction,Upcycling,Sustainable Living,Food Waste Management,Community Initiatives,Environmental Advocacy',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Optional image upload with size limit
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.min' => 'Le titre doit contenir au moins :min caractères.',
            'title.max' => 'Le titre ne peut pas dépasser :max caractères.',
            'description.required' => 'La description est obligatoire.',
            'category.required' => 'La catégorie est obligatoire.',
            'category.in' => 'La catégorie sélectionnée n\'est pas valide.',
            'picture.image' => 'Le fichier doit être une image.',
            'picture.mimes' => 'Les formats d\'image autorisés sont jpeg, png, jpg, gif.',
        ];
    }
}
