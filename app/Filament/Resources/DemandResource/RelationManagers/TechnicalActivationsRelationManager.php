<?php

namespace App\Filament\Resources\DemandResource\RelationManagers;

use App\Models\City;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TechnicalActivationsRelationManager extends RelationManager
{
    protected static string $relationship = 'technical_activations';

    public function form(Form $form): Form
    {

        /*
         $table->uuid('id')->primary();
            $table->string('demand_id');
            $table->string('team_id');
            $table->string('start_city');
            $table->string('work_city');
            $table->string('end_city');
            $table->string('start_at');
            $table->string('end_at');
         */

        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->options(Team::all()->pluck('name', 'id')),
                Forms\Components\Select::make('start_city')
                    ->searchable()
                    ->options(City::all()->pluck('name', 'id')),
                Forms\Components\Select::make('end_city')
                    ->searchable()
                    ->options(City::all()->pluck('name', 'id')),
                Forms\Components\DateTimePicker::make('start_at')->required(),
                Forms\Components\DateTimePicker::make('end_at'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Acionamentos')
            ->columns([
                Tables\Columns\TextColumn::make('Acionamentos'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
