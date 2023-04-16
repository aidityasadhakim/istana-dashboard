<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimPaids extends Model
{
    use HasFactory;
    protected $table = "claim_paids";
    protected $guarded = ["id"];
    protected $hidden = [];
}
