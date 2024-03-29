<?php

namespace App\Filament\Resources\CityGeolocationResource\Pages;

use App\Filament\Resources\CityGeolocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCityGeolocations extends ListRecords
{
    protected static string $resource = CityGeolocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
