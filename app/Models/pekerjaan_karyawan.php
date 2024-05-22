<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pekerjaan_karyawan extends Model
{
    protected $table = "pekerjaan_karyawan";
    protected $primaryKey = "id";
    use HasFactory;
}
