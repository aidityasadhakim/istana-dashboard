<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;
    protected $table = "sale_details";
    protected $guarded = ["id"];
    protected $hidden = [];

    public function sale()
    {
        return $this->belongsTo(Sales::class, "sale_id");
    }
}
