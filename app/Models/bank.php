<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $table = "bank";
    protected $primaryKey = "id";
    use HasFactory;
}
