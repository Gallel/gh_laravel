<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;

/**
 * The Alumne model represents a student.
 *
 * It defines the attributes that can be mass assigned and the relationship
 * indicating that a student belongs to a class.
 */
class Alumne extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'cognom',
        'dataNaixement',
        'NIF',
        'classe_id'
    ];

    /**
     * Get the classe that the student belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
