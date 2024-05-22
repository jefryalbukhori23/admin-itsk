<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class default_regenci extends Model
{
    protected $table = "default_regencies";
    protected $primaryKey = "id";
    use HasFactory;
}
