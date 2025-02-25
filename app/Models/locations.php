<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{

    use HasFactory;
    protected $fillable = ['x', 'y', 'crews_id', 'year']; // Agrega los campos que quieres permitir
public function crew()
    {
        return $this->belongsTo(crews::class);  // Crew es el modelo relacionado
    }
}
