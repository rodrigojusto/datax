<?php

namespace App\Filament\Resources\TeamBaseResource\Pages;

use App\Filament\Resources\TeamBaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamBase extends EditRecord
{
    protected static string $resource = TeamBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
