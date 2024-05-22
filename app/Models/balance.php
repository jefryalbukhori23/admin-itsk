<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance extends Model
{
    protected $table = "balance";
    protected $primaryKey = "id";
    use HasFactory;
}
