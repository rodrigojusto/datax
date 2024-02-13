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

    protected static ?string $title = 'Acionamentos Técnicos';
    protected static string $relationship = 'technical_activations';
    protected static ?string $modelLabel = 'Acionamento Técnico';
    protected static ?string $pluralModelLabel = 'Acionamentos Técnicos';

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->label('Equipe')
                    ->searchable()
                    ->options(Team::all()->pluck('name', 'id'))
                    ->live(),
                /*Forms\Components\Hidden::make('start_city')
                    ->options(function (Callable $get){
                        $state = State::find($get('team_id'));
                        if(!$state){
                            // Obter atravéz do team_base a cidade de partida do evento
                            return City::all()->pluck('name', 'id');
                        }

                        return $state->cities->pluck('name', 'id');
                    })
                ,*/

                Forms\Components\Select::make('start_city')
                    ->relationship()
                    ->label('Cidade Partida')
                    ->searchable()
                    ->options(City::all()->pluck('name', 'id')),
                Forms\Components\Select::make('work_city')
                    ->label('Cidade Evento')
                    ->searchable()
                    ->options(City::all()->pluck('name', 'id')),
                Forms\Components\DateTimePicker::make('start_at')
                    ->label('Inicio acionamento')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_at')
                    ->label('Fim Acionamento'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Acionamentos')
            ->columns([
                Tables\Columns\TextColumn::make('team.name')
                ->label('Equipe'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->icon('heroicon-o-user'),
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
