<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Cassandra\Rows;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use OpenSpout\Common\Entity\Row;
use PHPUnit\Metadata\Group;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Parametrizações';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Toggle::make('isInternal')
                    ->required(),
                Forms\Components\TextInput::make('teamTypes'),
                Forms\Components\TextInput::make('answerable'),
                Forms\Components\TextInput::make('cnpj'),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Tables\Columns\IconColumn::make('isInternal')
                            ->label('Interno')
                            ->boolean(),
                        Tables\Columns\TextColumn::make('name')
                            ->weight(FontWeight::Bold)
                            ->searchable()
                            ->sortable('asc'),
                        Tables\Columns\TextColumn::make('teamTypes')
                            ->label('Tipos')
                            ->searchable(),
                    ]),
                    Stack::make([
                        Tables\Columns\TextColumn::make('answerable')
                            ->label('Responsável')
                            ->searchable(),
                        Tables\Columns\TextColumn::make('cnpj')
                            ->label('CNPJ')
                            ->searchable(),
                    ])->alignment(Alignment::Center),
                    Stack::make([
                        Tables\Columns\TextColumn::make('created_at')
                            ->label('Criado em:')
                            ->dateTime()
                            ->sortable()
                            ->toggledHiddenByDefault(true)
                            ->toggleable(isToggledHiddenByDefault: true),
                        Tables\Columns\TextColumn::make('updated_at')
                            ->label('Atualizado em:')
                            ->dateTime()
                            ->sortable()
                            ->toggledHiddenByDefault(true)
                            ->toggleable(isToggledHiddenByDefault: true),
                        ])->alignment(Alignment::End),
                    ]),
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
