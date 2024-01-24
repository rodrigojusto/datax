<?php

namespace App\Livewire\Demand;

use App\Models\Base;
use App\Models\City;
use App\Models\ContractType;
use App\Models\DemandType;
use App\Models\ServiceType;
use App\Models\State;
use Carbon\Carbon;
use Carbon\PHPStan\AbstractMacro;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    #[rule('required')]
    public string $service_type_id;

    #[rule('required')]
    public string $contract_type_id;

    #[rule('required')]
    public string $demand_type_id;

    #[rule('required|min:5')]
    public string $designation;

    #[rule('required')]
    public string $city_id;

    #[rule('required')]
    public string $base_id;

    public string $opened_at;
    public string $created_by;
    public string $observation;

    // variaveis para preenchimento de combos
    public $states;
    public $cities;
    public $bases;
    public $service_types;
    public $contract_types;
    public $demand_types;

    public $selectedState;

    public function mount()
    {
        $this->states = State::all();
        $this->cities = collect();
        $this->bases = Base::all();
        $this->service_types = ServiceType::all();
        $this->contract_types = ContractType::all();
        $this->demand_types = DemandType::all();
    }

    public function updateSelectedState($value)
    {
        if ($value) {
            $this->cities = City::where('state_id', $value)->get();
        } else {
            $this->cities = collect(); // Reseta a lista de cidades se nenhum estado for selecionado
        }
    }

    public function render()
    {
        return view('livewire.demand.create');
    }

    public function save()
    {

        Demand::query()
            ->create([
                'service_type_id' => $service_type_id,
                'contract_type_id' => $contract_type_id,
                'demand_type_id' => $demand_type_id,
                'designation' => $designation,
                'city_id' => $city_id,
                'base_id' => $base_id,
                'opened_at' => DB::select('select now() as dt')[0]->dt,
                'created_by' => Auth::id(),
                'observation' => $observation,

            ]);
    }
}
