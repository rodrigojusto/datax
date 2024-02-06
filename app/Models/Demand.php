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
        return $this->hasOne(Base::class);
    }
    public function contract_type()
    {
        return $this->hasOne(ContractType::class);
    }

    public function demand_type()
    {
        return $this->hasOne(DemandType::class);
    }

    public function service_type()
    {
        return $this->hasOne(ServiceType::class);
    }

    public function justification()
    {
        return $this->hasOne(Justfication::class);
    }

    public function technical_activation()
    {
        return $this->hasMany(TechnicalActivation::class);
    }
}
