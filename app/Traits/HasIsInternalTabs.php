<?php

namespace App\Traits;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

trait HasIsInternalTabs
{

    public function getTabs(): array
    {

        $model = static::getModel()::query();
        $total = $model->count();
        $internal = $model->where('isInternal', true)->count();
        $external = $total - $internal;
        return [
            'all' => Tab::make('Todos')
                ->icon('heroicon-o-bars-4')
                ->badge($total),
            'internal' => Tab::make('Interno')
                ->icon('heroicon-o-check-circle')
                ->badge($internal)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('isInternal', true)),
            'external' => Tab::make('Terceiro')
                ->icon('heroicon-o-x-circle')
                ->badge($external)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('isInternal', false)),
        ];
    }
}
