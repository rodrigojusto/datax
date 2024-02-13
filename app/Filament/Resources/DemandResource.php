<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandResource\Pages;
use App\Filament\Resources\DemandResource\RelationManagers;
use App\Models\Base;
use App\Models\ContractType;
use App\Models\DemandType;
use App\Models\ServiceType;
use App\Models\State;
use App\Models\City;
use App\Models\Demand;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
use phpDocumentor\Reflection\Types\Callable_;
use function Pest\Laravel\get;

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
            Tabs::make()
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Informações do Evento')
                    ->columns(5)
                    ->schema([
                        Forms\Components\Fieldset::make('Classificação da Demanda')
                            ->columns(3)
                            ->schema([
                                Forms\Components\Select::make('demand_type_id')
                                    ->label('Tipo de Demanda')
                                    ->options(DemandType::all()->pluck('name', 'id')->toArray())
                                    /*->default(DemandType::query()
                                        ->where('name','=','Suporte')
                                        //->first()
                                        ->pluck('id')->toArray()
                                    )*/
                                    ->required(),
                                Forms\Components\Select::make('contract_type_id')
                                    ->label('Contrato')
                                    ->reactive()
                                    ->options(ContractType::all()->pluck('name', 'id')->toArray())
                                    ->afterStateUpdated(fn(callable $set) => $set('service_type_id', null))
                                    ->required(),
                                Forms\Components\Select::make('service_type_id')
                                    ->label('Serviço')
                                    ->reactive()
                                    ->options(function (Callable $get){
                                        $contract_type = ContractType::find($get('contract_type_id'));
                                        if(!$contract_type){
                                            return ServiceType::all()->pluck('name', 'id');
                                        }
                                        return $contract_type->service_types->pluck('name', 'id');
                                    })
                                    ->required(),
                            ]),

                        Forms\Components\Fieldset::make('Informações da Demanda')
                            ->columns(5)
                            ->schema([
                                Forms\Components\TextInput::make('designation')
                                    ->columnSpanFull()
                                    ->label('Designação')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('state_id')
                                    ->label('Estado')
                                    ->required()
                                    ->reactive()
                                    ->options(State::all()->pluck('name', 'id')->toArray())
                                    ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),
                                Forms\Components\Select::make('city_id')
                                    ->columnSpan(2)
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
                                    ->relationship('base', 'name')
                                    ->label('Base')
                                    ->searchable(['name'])
                                    ->required(),
                                Forms\Components\DateTimePicker::make('sinos_activation_at')
                                    ->required(),
                                /*Forms\Components\TextInput::make('created_by')
                                    ->default(auth()->id()),*/
                                Forms\Components\Hidden::make('closed_at'),
                                Forms\Components\Hidden::make('closed_by'),
                                /*Forms\Components\TextInput::make('justification_id')
                                    ->maxLength(255),*/
                            ]),
                    ]),

                    Tabs\Tab::make('Observação')
                        ->schema([
                            Forms\Components\Textarea::make('observation')
                                ->hiddenLabel(true)
                                ->maxLength(255)
                                ->columnSpan(2),
                    ]),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                Tables\Columns\TextColumn::make('demand_type.name')
                    ->label('Demanda')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contract_type.name')
                    ->label('Contrato')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_type.name')
                    ->label('Serviço')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->label('Designação')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Cidade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base.name')
                    ->label('Base')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sinos_activation_at')
                    ->label('Ac. Sinos')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('closed_at')
                    ->label('Dt Fechamento')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                /*Tables\Columns\TextColumn::make('created_by')
                    ->label('Criado Por')
                    ->toggleable(isToggledHiddenByDefault: true),*/
                Tables\Columns\TextColumn::make('closed_by')
                    ->label('Fechado por')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('observation')
                    ->label('Observações')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('justification_id')
                    ->label('Justificativa')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\ViewAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TechnicalActivationsRelationManager::class,
            RelationManagers\DemandObservationsRelationManager::class,
            RelationManagers\DemandImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            //'index' => Pages\ManageDemands::route('/'),
            //'export'=> Pages\ManageDemands::route('/export'),

            'index' => Pages\ListDemands::route('/'),
            'create' => Pages\CreateDemands::route('/create'),
            'edit' => Pages\EditDemand::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::query()->where('closed_at', null)->count();// ::whereNull('closed_at')
    }
}
