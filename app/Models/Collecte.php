<?php

namespace App\Models;

use App\Enums\EtatCollecte;
use App\Enums\TypeDechet;
use App\Models\FluxDeDonnees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collecte extends Model
{
    use HasFactory;
    protected $table = 'collecte';
    protected $fillable = [
        'nom',
        'etat',
        'type_dechet',
        'contenu',
        'output',
        'output_description',
        'image',
        'poids_contenu',
        'centre_de_recyclage_id'
    ];

    protected $casts = [
        'output' => 'array',
        'etat' => EtatCollecte::class,
        'type_dechet' => TypeDechet::class,
    ];
    public function centreDeRecyclage()
    {
        return $this->belongsTo(CentreDeRecyclage::class);
    }
    public function fluxDeDonnees()
{
    return $this->hasOne(FluxDeDonnees::class);
}

}
