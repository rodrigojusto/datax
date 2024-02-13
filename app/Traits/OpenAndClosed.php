<?php

namespace App\Traits;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

trait OpenAndClosed
{
    public function getTabs(): array
    {
        $model = static::getModel()::query();
        $total = $model->count();
        $active = $model->where('closed_at', null)->count();
        $inactive = $model->whereNotNull('closed_at')->count();
        return [
            'all' => Tab::make('Todos')
                ->icon('heroicon-o-bars-4')
                ->badge($total)
        ,
            'active' => Tab::make('Abertos')
                ->icon('heroicon-o-lock-open')
                ->badge($active)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('closed_at', null)),
            'inactive' => Tab::make('Encerrados')
                ->icon('heroicon-o-lock-closed')
                ->badge($inactive)
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('closed_at')),
        ];
    }
}
