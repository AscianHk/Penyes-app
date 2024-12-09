<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_crews extends Model
{
    use HasFactory;

    // Definir la tabla que usará el modelo (si el nombre no sigue la convención)
    protected $table = 'users_crews'; 

    // Definir los atributos que son asignables
    protected $fillable = ['user_id', 'crews_id', 'year'];

    // Relación inversa: un registro de 'users_crews' pertenece a un 'user'
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación inversa: un registro de 'users_crews' pertenece a una 'crew'
    public function crew()
    {
        return $this->belongsTo(crews::class);
    }
    
}
