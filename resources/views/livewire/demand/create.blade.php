<div>
    <fieldset>
        <legend>Nova Demanda:</legend>
        <form wire:submit="save">
            <div class="">
                <x-label>Serviço</x-label>
                <select name="service_type_id" id="service_type_id" wire:model="demand.service_type_id" class="">
                    <option value="" selected> --- Selecione um Tipo de Serviço ---</option>
                    @empty($service_types)
                    @else
                        @foreach($service_types as $service_type)
                            <option value="{{$service_type->id}}">{{ $service_type->name }}</option>
                        @endforeach
                    @endisset
                </select>

                <x-label>Contrato</x-label>
                <select name="contract_type_id" id="contract_type_id" wire:model="demand.contract_type_id">
                    <option value="" selected> --- Selecione um Tipo de Contrato ---</option>
                    @foreach($contract_types as $contract_type)
                        <option value="{{$contract->id}}">{{ $contract->name }}</option>
                    @endforeach
                </select>

                <x-label>Tipo</x-label>
                <select name="demand_type_id" id="demand_type_id"  wire:model="demand.demand_type_id">
                    <option value="" selected> --- Selecione um Tipo de Demanda ---</option>
                    @foreach($demand_types as $demand_type)
                        <option value="{{$demand->id}}">{{ $demand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label>Designação</x-label>
                <input type="text" name="designation" wire:model="designation"/>
                @error('designation') <div>{{$message}}</div> @enderror

                <x-label for="selectedState">Estado:</x-label>
                <select wire:model.live="demand.selectedState">
                    <option value=""> --- Selecione um estado --- </option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>

                <x-label for="selectedCity">Cidade:</x-label>
                <select wire:model.live="demand.city_id" {{ $selectedState ? '' : 'disabled' }}>
                    <option value="">Selecione uma cidade</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>

                <x-label>Base</x-label>
                <select name="demand_type_id" id="base_id"  wire:model.live="demand.base_id">
                    <option value="" selected> --- Selecione um Tipo de Demanda ---</option>
                    @foreach($bases as $base)
                        <option value="{{$base->id}}">{{ $base->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label>Observações</x-label>
                <textarea wire="observations"></textarea>
            </div>
            <x-button type="submit">Salvar</x-button>
        </form>
    </fieldset>
</div>
