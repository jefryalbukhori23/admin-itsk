<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatan_berbayar extends Model
{
    protected $table = "kegiatan_berbayar";
    protected $primaryKey = "id";
    use HasFactory;
}
