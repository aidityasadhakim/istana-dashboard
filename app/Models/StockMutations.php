<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutations extends Model
{
    use HasFactory;
    protected $table = "stock_mutations";
    protected $guarded = ["id"];
    protected $hidden = [];
}
