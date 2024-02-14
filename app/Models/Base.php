<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;
    use HasUuids;

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
