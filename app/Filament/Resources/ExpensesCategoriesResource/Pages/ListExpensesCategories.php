<?php

namespace App\Filament\Resources\ExpensesCategoriesResource\Pages;

use App\Filament\Resources\ExpensesCategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpensesCategories extends ListRecords
{
    protected static string $resource = ExpensesCategoriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
