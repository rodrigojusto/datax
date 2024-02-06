<?php

namespace App\Traits;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

trait HasIsActiveTabs
{

    public function getTabs(): array
    {

        $model = static::getModel()::query();
        $total = $model->count();
        $active = $model->whereIs_active(true)->count();
        $inactive = $model->whereIs_active(false)->count();
        return [
            'all' => Tab::make('Todos')
                ->icon('heroicon-o-bars-4')
                ->badge($total),
            'active' => Tab::make('Ativos')
                ->icon('heroicon-o-check-circle')
                ->badge($active)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make('Inativos')
                ->icon('heroicon-o-x-circle')
                ->badge($inactive)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false)),
        ];
    }
}
