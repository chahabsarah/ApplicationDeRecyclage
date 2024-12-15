<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FluxDeDonnees extends Model
{
    use HasFactory;

    protected $table = 'flux_de_donnees';

    // A flux_de_donnees belongs to a single collecte
    public function collecte()
    {
        return $this->belongsTo(Collecte::class);
    }
  

    // A flux_de_donnees can have many phases
    public function phases()
    {
        return $this->hasMany(Phase::class);
    }

    // Method to add a new phase to the flux_de_donnees
    public function addPhase($etat, $outputImages, $outputDescription)
    {
        $this->phases()->create([
            'etat' => $etat,
            'output_images' => $outputImages,
            'output_description' => $outputDescription,
        ]);
    }
}
