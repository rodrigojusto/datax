<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandResource\Pages;
use App\Filament\Resources\DemandResource\RelationManagers;
use App\Models\DemandType;
use App\Models\State;
use App\Models\City;
use App\Models\Demand;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use phpDocumentor\Reflection\Types\Callable_;

class DemandResource extends Resource
{
    protected static ?string $model = Demand::class;

    protected static ?string $navigationGroup = 'Operacional';
    protected static ?string $navigationLabel = 'Demandas Técnicas';
    protected static ?string $modelLabel = 'Demanda Técnica';
    protected static ?string $pluralModelLabel = 'Demandas Técnicas';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               /* Tabs::make('Tabs')
                    ->tab({
                    Tabs\Tab::make('Principal')
                        ->schema([
                            //
                        ]),
                    Tabs\Tab::make('Acionamento')
                        ->schema([
                            //
                        ]),
                    Tabs\Tab::make('Detalhes')
                        ->schema([
                            //
                        ]),
                    Tabs\Tab::make('Fechamento')
                        ->schema([
                            //
                        ]),
                }),*/
                Forms\Components\Select::make('demand_type_id')
                    ->label('Demanda')
                    ->required()
                    ->relationship('demand_type','name')
                    ->default(DemandType::query()
                        ->where('name','=','Suporte')
                        ->first()
                        ->pluck('id')
                    )
                    ->selectablePlaceholder(false),
                Forms\Components\Select::make('service_type_id')
                    ->label('Serviço')
                    ->required()
                    ->relationship('service_type', 'name'),
                Forms\Components\Select::make('contract_type_id')
                    ->label('Contrato')
                    ->required()
                    ->relationship('contract_type', 'name'),
                Forms\Components\TextInput::make('designation')
                    ->label('Designação')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('state_id')
                    ->label('Estado')
                    ->options(State::all()->pluck('name', 'id')-> toArray())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),
                Forms\Components\Select::make('city_id')
                    ->label('Cidade')
                    ->options(function (Callable $get){
                        $state = State::find($get('state_id'));
                        if(!$state){
                            return City::all()->pluck('name', 'id');
                        }
                        return $state->cities->pluck('name', 'id');
                    })
                    ->searchable(['name'])
                    ->required()
                    ->reactive(),
                Forms\Components\Select::make('base_id')
                    ->label('Base')
                    ->required()
                    ->relationship('base', 'id'),
                Forms\Components\Hidden::make('opened_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('sinos_activation_at')
                    ->required(),
                Forms\Components\Hidden::make('closed_at'),
                Forms\Components\Hidden::make('created_by_type'),
                Forms\Components\Hidden::make('created_by_id'),
                Forms\Components\Hidden::make('closed_by_type'),
                Forms\Components\Hidden::make('closed_by'),
                Forms\Components\Textarea::make('observation')
                    ->maxLength(255)
                    ->columnSpan(2),
                /*Forms\Components\TextInput::make('justification_id')
                    ->maxLength(255),*/
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDemands::route('/'),
            'export'=> Pages\ManageDemands::route('/export'),
        ];
    }
}
