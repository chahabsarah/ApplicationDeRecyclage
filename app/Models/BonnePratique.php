<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonnePratique extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'picture',
    ];
   
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
