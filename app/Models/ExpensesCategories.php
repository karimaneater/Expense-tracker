<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpensesCategories extends Model
{
    use HasFactory;

    public $table = "expense_categories";

    protected $fillable = [
        'expense_category',
        'exp_cat_description',
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expenses::class, 'expense_category_id');
    }
}
