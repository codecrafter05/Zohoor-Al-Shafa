<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Models\Category;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->options(fn () => Category::orderBy('label_en')->pluck('label_en', 'id'))
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name_en')->label('Name (EN)')->required()->maxLength(255),
                TextInput::make('name_ar')->label('Name (AR)')->required()->maxLength(255),
                Textarea::make('description_en')->label('Description (EN)')->rows(3)->maxLength(500),
                Textarea::make('description_ar')->label('Description (AR)')->rows(3)->maxLength(500),
                TextInput::make('price')->label('Price')->numeric()->required()->step('0.01'),
                TextInput::make('currency')->label('Currency')->default('BHD')->disabled(),
                FileUpload::make('image_path')
                    ->label('Image')
                    ->image()
                    ->disk('public')
                    ->directory('products/images')
                    ->imageEditor(),
                Toggle::make('is_active')->label('Active')->default(true),
                Toggle::make('is_favorite')->label('Favorite')->default(false),
                TextInput::make('sort_order')->numeric()->default(0)->label('Sort Order'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->label('Image')->disk('public'),
                TextColumn::make('category.label_en')->label('Category')->sortable()->searchable(),
                TextColumn::make('name_en')->label('Name EN')->sortable()->searchable(),
                TextColumn::make('name_ar')->label('Name AR')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('description_en')->label('Description EN')->toggleable(isToggledHiddenByDefault: true)->limit(50),
                TextColumn::make('description_ar')->label('Description AR')->toggleable(isToggledHiddenByDefault: true)->limit(50),
                TextColumn::make('price')->label('Price')->money('BHD', divideBy: 1)->sortable(),
                IconColumn::make('is_active')->boolean()->label('Active')->sortable(),
                IconColumn::make('is_favorite')->boolean()->label('Favorite')->sortable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
