<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Alumne;

/**
 * The Classe model represents a school class.
 *
 * It defines the attributes that can be mass assigned and the relationship
 * indicating that a class can have many students.
 */
class Classe extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grup',
        'nomTutor',
    ];

    /**
     * Get the students for the class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alumnes()
    {
        return $this->hasMany(Alumne::class);
    }
}
