<?php

namespace App\Filament\Resources\TechnicalActivationResource\Pages;

use App\Filament\Resources\TechnicalActivationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTechnicalActivation extends EditRecord
{
    protected static string $resource = TechnicalActivationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
