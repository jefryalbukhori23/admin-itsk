<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
    protected $table = "registration";
    protected $primaryKey = "id";
    use HasFactory;
}
