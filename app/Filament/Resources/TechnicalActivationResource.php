<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicalActivationResource\Pages;
use App\Filament\Resources\TechnicalActivationResource\RelationManagers;
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
    protected static ?string $navigationParentItem = 'Demandas Técnicas';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ListTechnicalActivations::route('/'),
            'create' => Pages\CreateTechnicalActivation::route('/create'),
            'edit' => Pages\EditTechnicalActivation::route('/{record}/edit'),
        ];
    }
}
