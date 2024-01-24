<?php

namespace App\Filament\Resources\TecnicalActivationResource\Pages;

use App\Filament\Resources\TecnicalActivationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTecnicalActivation extends EditRecord
{
    protected static string $resource = TecnicalActivationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
