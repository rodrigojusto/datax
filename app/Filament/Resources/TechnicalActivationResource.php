<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicalActivationResource\Pages;
use App\Filament\Resources\TechnicalActivationResource\RelationManagers;
use App\Models\City;
use App\Models\Team;
use App\Models\TechnicalActivation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TechnicalActivationResource extends Resource
{
    protected static ?string $model = TechnicalActivation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $isDiscovered = false;
    protected static ?string $navigationGroup = 'Operacional';
    protected static ?string $navigationLabel = 'Acionamentos Técnicos';
    protected static ?string $pluralModelLabel = 'Acionamentos Técnicos';
    protected static ?string $modelLabel = 'Acionamento Técnico';

    public static function form(Form $form): Form
    {

        /*
        demand_id
        team_id
        start_city
        work_city
        end_city
        start_at
        end_at
         */
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->label('Equipe')
                    ->searchable()
                    ->options(Team::all()->pluck('name', 'id')),
                Forms\Components\Select::make('start_city')
                    ->label('Cidade Partida')
                    ->searchable()
                    ->options(City::all()->pluck('name', 'id')),
                Forms\Components\Select::make('work_city')
                    ->label('Cidade Evento')
                    ->searchable()
                    ->options(City::all()->pluck('name', 'id')),
                Forms\Components\DateTimePicker::make('start_at')->required(),
                Forms\Components\DateTimePicker::make('end_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTechnicalActivations::route('/'),

        ];
    }
}
