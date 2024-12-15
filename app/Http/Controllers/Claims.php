<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    use HasFactory;
    protected $fillable = [
        "description",
        "categories_id",
        "username",
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
