<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konten extends Model
{
    protected $table = "konten";
    protected $primaryKey = "id";
    use HasFactory;
}
