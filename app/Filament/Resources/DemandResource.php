<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandResource\Pages;
use App\Filament\Resources\DemandResource\RelationManagers;
use App\Models\Demand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DemandResource extends Resource
{
    protected static ?string $model = Demand::class;

    protected static ?string $navigationGroup = 'Operacional';
    protected static ?string $navigationLabel = 'Demanda Técnica';
    protected static ?string $modelLabel = 'Demanda Técnica';
    protected static ?string $pluralModelLabel = 'Demandas Técnicas';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('contract_type_id_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contract_type_id_id')
                    ->required(),
                Forms\Components\TextInput::make('demand_type_id_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('demand_type_id_id')
                    ->required(),
                Forms\Components\TextInput::make('service_type_id_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('service_type_id_id')
                    ->required(),
                Forms\Components\TextInput::make('designation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('base_id_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('base_id_id')
                    ->required(),
                Forms\Components\DateTimePicker::make('opened_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('sinos_activation_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('closed_at'),
                Forms\Components\TextInput::make('created_by_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('created_by_id')
                    ->required(),
                Forms\Components\TextInput::make('closed_by')
                    ->maxLength(255),
                Forms\Components\TextInput::make('observation')
                    ->maxLength(255),
                Forms\Components\TextInput::make('justification_id')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('contract_type_id_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contract_type_id_id'),
                Tables\Columns\TextColumn::make('demand_type_id_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('demand_type_id_id'),
                Tables\Columns\TextColumn::make('service_type_id_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_type_id_id'),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_id_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_id_id'),
                Tables\Columns\TextColumn::make('opened_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sinos_activation_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('closed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by_id'),
                Tables\Columns\TextColumn::make('closed_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('observation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('justification_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListDemands::route('/'),
            'create' => Pages\CreateDemand::route('/create'),
            'edit' => Pages\EditDemand::route('/{record}/edit'),
        ];
    }
}
