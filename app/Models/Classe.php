<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    public function alumnes()
    {
        return $this->hasMany(Alumne::class);
    }
}
