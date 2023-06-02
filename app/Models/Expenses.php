<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expenses extends Model
{
    use HasFactory;

    public $table = "expenses";

    protected $fillable = [
        'expense_category_id',
        'amount',
        'entry_date',
    ];

    public function expensesCategory(): BelongsTo
    {
        return $this->belongsTo(ExpensesCategories::class, 'expense_category_id');
    }
}
