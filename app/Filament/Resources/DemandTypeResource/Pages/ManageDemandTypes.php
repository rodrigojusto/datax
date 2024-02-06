<?php

namespace App\Filament\Resources\DemandTypeResource\Pages;

use App\Filament\Resources\DemandTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDemandTypes extends ManageRecords
{
    protected static string $resource = DemandTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
