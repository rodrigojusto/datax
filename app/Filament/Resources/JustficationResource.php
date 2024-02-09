<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JustficationResource\Pages;
use App\Filament\Resources\JustficationResource\RelationManagers;
use App\Models\Client;
use App\Models\Justfication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class JustficationResource extends Resource
{
    protected static ?string $model = Justfication::class;

    protected static ?string $navigationGroup = 'Parametrizações';
    protected static ?string $navigationLabel = 'Justificativas';
    protected static ?string $modelLabel = 'Justificativa';
    protected static ?string $pluralModelLabel = 'Justificativas';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('client_id')
                    ->options(Client::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Toggle::make('is_improdutive')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                    //'client' => fn(Builder $query) => $query->where('id','=', 'client_id')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_improdutive')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
                Tables\Filters\SelectFilter::make('is_improdutive')
                    ->options([
                        true => 'Sim',
                        false => 'Não',
                    ])
                    ->label('Improdutivas'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ExportAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('Ativar')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle')
                        ->action(fn(Collection $justifications) => $justifications->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('Desativar')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-x-circle')
                        ->action(fn(Collection $justifications) => $justifications->each->update(['is_active' => false])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageJustfications::route('/'),
        ];
    }
}
