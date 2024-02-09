<?php

namespace App\Filament\Resources\DemandResource\Pages;

use App\Filament\Resources\DemandResource;
use App\Traits\OpenAndClosed;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDemands extends ListRecords
{
    use OpenAndClosed;
    protected static string $resource = DemandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
