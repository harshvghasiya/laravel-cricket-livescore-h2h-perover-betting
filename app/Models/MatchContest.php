<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchContest extends Model
{
    use HasFactory;
    protected $table='match_contest';

    public function contest_match()
    {
    	return $this->belongsTo('\App\Models\LiveMatch','match_id','id');
    }
}
