<?php

namespace App\Filament\Resources\DemandTypeResource\Pages;

use App\Filament\Resources\DemandTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDemandType extends EditRecord
{
    protected static string $resource = DemandTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
