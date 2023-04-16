<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtPaids extends Model
{
    use HasFactory;
    protected $table = "debt_paids";
    protected $guarded = ["id"];
    protected $hidden = [];
}
