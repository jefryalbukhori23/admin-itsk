<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $table = "karyawan";
    protected $primaryKey = "id";
    use HasFactory;
}
