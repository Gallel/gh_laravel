<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumne extends Model
{
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
