<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = ['bonne_pratique_id', 'nom', 'photo', 'description'];

    public function bonnePratique()
    {
        return $this->belongsTo(BonnePratique::class);
    }
}
