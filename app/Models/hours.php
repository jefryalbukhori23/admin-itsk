<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hours extends Model
{
    protected $table = "hours";
    protected $primaryKey = "id";
    use HasFactory;
}
