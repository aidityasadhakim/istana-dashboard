<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    use HasFactory;
    protected $table = "payment_methods";
    protected $guarded = ["id"];
    protected $hidden = [];

    public function sales()
    {
        return $this->hasMany(Sales::class, "method_id", "id");
    }
}
