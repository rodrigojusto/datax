<?php

namespace App\Filament\Resources\BaseResource\Pages;

use App\Filament\Resources\BaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBases extends ManageRecords
{
    protected static string $resource = BaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
