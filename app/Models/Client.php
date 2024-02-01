<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    use HasFactory;
    use HasUuids;
    protected $connection = 'sinos_erp';

    public function contracts(){
        return $this->hasMany(ContractType::class);
    }

}
