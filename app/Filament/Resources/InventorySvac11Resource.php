<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\EntryUnit;
use App\Models\PeriodList;
use Filament\Tables\Table;
use App\Models\BrandMaterial;
use App\Models\MaterialUsage;
use App\Models\InventorySvac11;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InventorySvac11Resource\Pages;
use App\Filament\Resources\InventorySvac11Resource\RelationManagers;

class InventorySvac11Resource extends Resource
{
    protected static ?string $model = InventorySvac11::class;

    protected static ?string $navigationIcon = 'bi-fuel-pump';

    protected static ?string $navigationGroup = 'Scope 1';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = "Fuels Consumption";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* TODO: Not save to database when inventory fails to save */
                Forms\Components\Section::make('Inventory Period')
                    ->description('Define the period of the inventory')
                    ->schema([
                        Forms\Components\Select::make('entry_period_id')
                            ->relationship('entryPeriod', 'name')
                            ->live()
                            ->required(),
                        Forms\Components\Select::make('period_list_id')
                            ->label('Period')
                            ->disabled(fn(Forms\Get $get): bool => ! filled($get('entry_period_id')))
                            ->options(function (Forms\Get $get, $operation) {
                                $query = PeriodList::query()
                                    ->where('entry_period_id', (int) $get('entry_period_id'))
                                    ->orderBy('period_value');
                
                                // If the form in Create mode, exclude the period_list_id already in InventorySvac11 table
                                if ($operation === 'create')
                                {
                                    $query->whereNotIn('id', InventorySvac11::all()->pluck('period_list_id'));
                                }
                                elseif ($operation === 'edit')
                                {
                                    // If the form in Edit mode, exclude the period_list_id already in InventorySvac11 table
                                    // and include the existing period_list_id of the record being edited
                                    $recordId = $get('id');
                                    $existingPeriodListId = InventorySvac11::find($recordId)->period_list_id;
                                    $query->where(function ($query) use ($existingPeriodListId) {
                                        $query->whereNotIn('id', InventorySvac11::all()->pluck('period_list_id'))
                                              ->orWhere('id', $existingPeriodListId);
                                    });
                                }
                
                                return $query->pluck('period_value', 'id');
                            })
                            ->required(),
                    ])
                    ->columns(2),

                /* TODO: When is_total is unchecked on create, the repeater item is null AND is still able to save */
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Hidden::make('id'), // Ensure the ID field is included

                        Forms\Components\Checkbox::make('is_total')
                            ->visibleOn('create')
                            ->label('We measure the volume of mobile and stationary')
                            ->live()
                            // ->afterStateUpdated(function (Closure $set, $state) {
                            //     // Perform additional logic
                            // }

                            /* default() value on view/edit is created by mutateFormDataBeforeFill() function on EditInventorySvac11.php */

                            ->default(true),


                        Forms\Components\Tabs::make('Fuels Tabs')
                            ->tabs(function (Forms\Get $get) {
                                // Get the value of the 'is_total' checkbox
                                $isTotal = $get('is_total');

                                // Log::debug('is_total: ' . $isTotal);

                                // Define the classifications
                                $filter = $isTotal ?? true
                                    // ? ['MOBILE-FUELS', 'STATIONARY-FUELS', 'TOTAL-FUELS'] // Classification 1: Mobile and Stationary Fuels
                                    ? ['MOBILE-FUELS', 'STATIONARY-FUELS'] // Classification 1: Mobile and Stationary Fuels
                                    : ['TOTAL-FUELS'];                    // Classification 2: Total Fuels
                                // Log::debug('is_total: ' . implode(',', $filter));

                                // Query MaterialUsage based on the classification
                                return MaterialUsage::whereIn('code', $filter)
                                    ->get()
                                    ->map(function ($usage) {
                                        Log::debug('Tab usage: ' . $usage);
                                        return Forms\Components\Tabs\Tab::make($usage->name)
                                            ->schema([
                                                Forms\Components\Repeater::make($usage->name . ' Consumptions')
                                                    ->label($usage->name . ' Consumptions')
                                                    ->defaultItems(1)
                                                    ->relationship('svac11Fuels', function (Builder $query) use ($usage) {
                                                        return $query->where('material_usage_id', $usage->id);
                                                    })
                                                    ->dehydrated() // put after relationship()
                                                    ->columns(3)
                                                    ->minItems(1)
                                                    ->schema([
                                                        Forms\Components\Select::make('brand_material_id')
                                                            ->label('Brand')
                                                            ->live()
                                                            ->searchable()
                                                            ->preload()
                                                            ->relationship('brandMaterial', 'name')
                                                            ->required(),
                                                        Forms\Components\Hidden::make('material_usage_id')
                                                            ->default(fn() => $usage->id),
                                                        Forms\Components\TextInput::make('consumption')
                                                            ->label('Consumption')
                                                            ->required()
                                                            ->numeric()
                                                            ->regex('/^(?!0(\.0+)?$)\d{1,8}(\.\d+)?$/')
                                                            ->validationMessages([
                                                                'regex' => 'The :attribute value and field format is invalid.',
                                                            ])
                                                            ->extraAttributes(['step' => '0.01', 'inputmode' => 'decimal'])
                                                            ->formatStateUsing(fn($state) => $state ? number_format((float) $state, 2, '.', '') : null),
                                                        Forms\Components\Select::make('entry_unit_id')
                                                            ->label('Unit')
                                                            ->relationship('entryUnit', 'unit')
                                                            ->disabled(fn(Forms\Get $get): bool => !filled($get('brand_material_id')))
                                                            ->options(fn(Forms\Get $get) => EntryUnit::whereHas('sourceMaterial', function (Builder $query) use ($get) {
                                                                $brandMaterialId = $get('brand_material_id');
                                                                if (!$brandMaterialId) {
                                                                    return [];
                                                                }
                                                                $som_id = BrandMaterial::find($get('brand_material_id'))->first()->id;
                                                                if (!$som_id) {
                                                                    return [];
                                                                }
                                                                $query->where('source_material_id', '=', $som_id);
                                                            })->pluck('unit', 'id'))
                                                            ->required(),
                                                        Forms\Components\Fieldset::make('Emission Calculation Result')
                                                            ->schema([
                                                                Forms\Components\TextInput::make('emission')
                                                                    ->label('Emission')
                                                                    ->hiddenOn('create')
                                                                    ->disabled()
                                                                    ->numeric()
                                                                    ->suffix('ton CO2e')
                                                                    ->formatStateUsing(fn($state) => number_format((float) $state, 2, '.', '')),
                                                                Forms\Components\TextInput::make('error_margin_pct')
                                                                    ->label('Uncertainty')
                                                                    ->hiddenOn('create')
                                                                    ->disabled()
                                                                    ->numeric()
                                                                    ->suffix('%')
                                                                    ->formatStateUsing(fn($state) => number_format((float) $state, 4, '.', '')),
                                                            ])
                                                            ->hiddenOn('create'),
                                                    ]),
                                            ]);
                                    })->toArray();
                            })
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('entryPeriod.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periodList.period_value')
                    ->label('Period')
                    ->numeric(thousandsSeparator: '')
                    ->sortable(),
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
            'index' => Pages\ListInventorySvac11s::route('/'),
            'create' => Pages\CreateInventorySvac11::route('/create'),
            'edit' => Pages\EditInventorySvac11::route('/{record}/edit'),
        ];
    }

    // public function store(array $formState)
    // {
    //     dd($formState);
    // }
}
