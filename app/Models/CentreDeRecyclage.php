<?php

namespace App\Models;

use App\Enums\TypeDechet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreDeRecyclage extends Model
{
    use HasFactory;
    protected $table = 'centres_de_recyclage';
    protected $fillable = [
        'nom',
        'localisation',
        'numero_telephone',
        'email',
        'site_web',
        'description',
        'type_dechet',
        'logo',

    ];
    protected $casts = [
        'type_dechet' => 'array',
    ];
    public function collectes()
    {
        return $this->hasMany(Collecte::class, 'centre_de_recyclage_id');
    }
}
