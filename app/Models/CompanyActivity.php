<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyActivity extends Model
{
    use HasFactory;

    public function activity()
    {
    	return $this->belongsTo('\App\Models\Activity','activity_id','id');
    }
}
