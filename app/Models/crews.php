<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crews extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'capacity'];


public function applications()
{
    return $this->hasMany(Application::class);
}
    public function users()
{
    return $this->belongsToMany(User::class, 'users_crews', 'crews_id', 'user_id')
                ->withPivot('year');
}

}


