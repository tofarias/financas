<?php

namespace Fin\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCosts extends Model
{
    protected $table = 'category_costs';

    protected $fillable = [
        'name'
    ];
}