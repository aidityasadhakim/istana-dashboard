<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;
    protected $table = "returns";
    protected $guarded = ["id"];
    protected $hidden = [];

    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sale_id', 'id');
    }
}
