<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = "country";
    protected $primaryKey = "id";
    use HasFactory;
}
