<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    use HasUuids;
    protected $connection = 'sinos_erp';

    public function cities(){
        return $this->hasMany(City::class);
    }
}
