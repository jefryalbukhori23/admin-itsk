<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class income extends Model
{
    protected $table = "income";
    protected $primaryKey = "id";
    use HasFactory;
}
