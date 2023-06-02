<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpensesCategoriesResource\Pages;
use App\Filament\Resources\ExpensesCategoriesResource\RelationManagers;
use App\Models\ExpensesCategories;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;

class ExpensesCategoriesResource extends Resource
{
    protected static ?string $model = ExpensesCategories::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([ TextInput::make('expense_category')
                            ->label('Expense Name')
                            ->maxlength(255)
                            ->required(),
                TextInput::make('exp_cat_description')
                            ->label('Description')
                            ->maxlength(255)
                            ->required(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_category')
                                            ->label('Expenses Name')
                                            ->sortable()
                                            ->searchable(),
                Tables\Columns\TextColumn::make('exp_cat_description')
                                            ->label('Description')
                                            ->sortable()
                                            ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                                            ->label('Created At')
                                            ->date()
                                            ->sortable()
                                            ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListExpensesCategories::route('/'),
            'create' => Pages\CreateExpensesCategories::route('/create'),
            'edit' => Pages\EditExpensesCategories::route('/{record}/edit'),
        ];
    }
}
