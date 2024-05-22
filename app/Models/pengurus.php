<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengurus extends Model
{
    protected $table = "pengurus";
    protected $primaryKey = "id";
    use HasFactory;
}
