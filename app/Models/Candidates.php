<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Candidates extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'year'
    ];

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skills::class, 'skill_sets', 'candidate_id', 'skill_id');
    }
}
