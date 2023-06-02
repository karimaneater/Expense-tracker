<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpensesResource\Pages;
use App\Filament\Resources\ExpensesResource\RelationManagers;
use App\Filament\Resources\ExpensesResource\ExpensesCategoriesRelationManagers;
use App\Models\ExpensesCategories;
use App\Models\Expenses;
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
use Filament\Forms\Components\BelongsToSelect;

class ExpensesResource extends Resource
{
    protected static ?string $model = Expenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Card::make()->schema([
                        Select::make('expense_category_id')
                                ->label('Expense categories')
                                ->relationship('expensesCategory','expense_category')
                                ->disablePlaceholderSelection()

                                ->required(),
                    TextInput::make('amount')
                                ->numeric()
                                ->minValue(1)
                                ->maxlength(255)
                                ->required(),
                    TextInput::make('entry_date')
                                ->type('date')
                                ->required(),])

            ]);

    }

    public static function table(Table $table): Table
    {
        //  $name = ExpensesCategories::whereIn('id','expense_category')->all();
        //  dd($name);
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expensesCategory.expense_category')
                                            ->label('Expenses Category')
                                            ->sortable()
                                            ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                                            ->sortable()
                                            ->searchable(),
                Tables\Columns\TextColumn::make('entry_date')
                                            ->label('Entry Date')
                                            ->date()
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



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpenses::route('/create'),
            'edit' => Pages\EditExpenses::route('/{record}/edit'),
        ];
    }
}
