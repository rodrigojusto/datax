<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;
    use HasUuids;

    public function service_types(){
        return $this->hasMany(ServiceType::class, 'contract_id','id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
