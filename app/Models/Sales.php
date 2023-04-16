<?php

namespace App\Models;

use App\Models\Returns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $guarded = ['id'];
    protected $hidden = [];

    public function returns()
    {
        return $this->hasMany(Returns::class, "sale_id", "id");
    }

    public function sale_details()
    {
        return $this->hasMany(SaleDetails::class, "sale_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, "customer_id", "id");
    }

    public function paymentmethods()
    {
        return $this->belongsTo(PaymentMethods::class, "method_id", "id");
    }
}
