<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;
    use HasUuids;

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function base()
    {
        return $this->belongsTo(Base::class);
    }
    public function contract_type()
    {
        return $this->belongsTo(ContractType::class);
    }

    public function demand_type()
    {
        return $this->belongsTo(DemandType::class);
    }

    public function justification()
    {
        return $this->belongsTo(Justfication::class);
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
