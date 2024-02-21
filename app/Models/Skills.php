<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function candidates()
    {
        return $this->belongsToMany(Candidates::class, 'skill_sets', 'skill_id', 'candidate_id');
    }
}
