<?php

namespace Filament\Widgets;

use App\Models\Expenses;
use App\Models\ExpensesCategories;
use Filament\Widgets\PieChartWidget;

class ExpensesChartWidget extends PieChartWidget
{
    protected function getType(): string
    {
        return 'pie';
    }
    protected function getHeading(): string
    {
        return 'Expenses';
    }


    protected function getData(): array
    {

        function getRandomColor() {
            $letters = str_split('0123456789ABCDEF');
            $color = '#';
            for ($i = 0; $i < 6; $i++) {
                $color .= $letters[rand(0, 15)];
            }
            return $color;
        }

        $exp_id = Expenses::all()->pluck('expense_category_id');

        $expenses = Expenses::all()->pluck('amount')->toArray();
        $label  = ExpensesCategories::all()->whereIn('id', $exp_id)->pluck('expense_category');

         // Generate random background colors
         $backgroundColor = [];
         foreach ($expenses as $item) {
             $backgroundColor[] = getRandomColor();
         }



            return [

                'labels' => $label,

                'datasets' => [
                    [
                        'label' => 'Expenses',
                        'data' => $expenses,
                        'backgroundColor' => $backgroundColor,
                        'hoverOffset' => 4
                    ],
                ],

            ];



    }
}
