<?php

namespace App\Filament\Resources\CityGeolocationResource\Pages;

use App\Filament\Resources\CityGeolocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCityGeolocation extends EditRecord
{
    protected static string $resource = CityGeolocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
