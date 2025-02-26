<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'crews_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class); 
          
    }

    public function crews()
    {
        return $this->belongsToMany(crews::class, 'users_crews', 'user_id', 'crews_id')
                    ->withPivot('year'); 
    }
}
