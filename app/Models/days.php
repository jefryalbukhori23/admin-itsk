<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class days extends Model
{
    protected $table = "days";
    protected $primaryKey = "id";
    use HasFactory;
}
