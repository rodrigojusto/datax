<?php

namespace App\Filament\Resources\JustficationResource\Pages;

use App\Filament\Resources\JustficationResource;
use App\Traits\HasIsActiveTabs;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJustfications extends ManageRecords
{
    use HasIsActiveTabs;
    protected static string $resource = JustficationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
