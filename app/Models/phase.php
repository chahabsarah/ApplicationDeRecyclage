<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $table = 'phases';

    protected $casts = [
        'output_images' => 'array',
    ];

    protected $fillable = [
        'etat',
        'output_images',
        'output_description',
        'flux_de_donnees_id', // Foreign key
    ];

    // A phase belongs to a flux_de_donnees
    public function fluxDeDonnees()
    {
        return $this->belongsTo(FluxDeDonnees::class);
    }
}
