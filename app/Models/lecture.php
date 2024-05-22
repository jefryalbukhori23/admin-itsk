<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    protected $table = "lecture";
    protected $primaryKey = "id";
    use HasFactory;
}
