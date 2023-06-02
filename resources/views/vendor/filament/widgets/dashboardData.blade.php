<x-filament::widget class="filament-account-widget">
    <x-filament::card>

            <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                Expense Categories
            </h2>
            <hr>
        @php

            $expenses = \App\Models\Expenses::all()->toArray();
            // dd($expenses);
        @endphp

        <div class="space-y-4 ">


                @foreach ($expenses as $expense)
                    @php
                        $expense_cat = \App\Models\ExpensesCategories::first()->where('id',$expense['expense_category_id'])->pluck('expense_category')->toArray();
                    @endphp
                     <div class="mr-2 flex justify-between">
                        <div>
                            {{$expense_cat[0]}}
                        </div>
                        <div>
                            &#8369;{{$expense['amount']}}
                        </div>

                    </div>
                @endforeach


        </div>
    </x-filament::card>
</x-filament::widget>
