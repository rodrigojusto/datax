<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalActivation extends Model
{
    use HasFactory;
    use HasUuids;

    public function demand(){
        return $this->belongsTo(Demand::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
