<?php

namespace App\Filament\Resources\TecnicalActivationResource\Pages;

use App\Filament\Resources\TecnicalActivationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTecnicalActivations extends ListRecords
{
    protected static string $resource = TecnicalActivationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
