<?php

namespace App\Models;

use App\Observers\DemandUserObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;
    use HasUuids;

    //protected $guarded = ['state_id'];


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

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function justification()
    {
        return $this->belongsTo(Justfication::class);
    }

    public function createdBy()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function technical_activations()
    {
        return $this->hasMany(TechnicalActivation::class);
    }

    public function demand_observations()
    {
        return $this->hasMany(DemandObservation::class);
    }

    public function demand_images()
    {
        return $this->hasMany(DemandImages::class);
    }
}
